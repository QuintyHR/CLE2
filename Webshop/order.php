<?php
require_once 'includes/database.php';
/** @var $db */

session_start();

$login = $_SESSION['login'];
$user_id = $_SESSION['userId'];
$emailAddress = $_SESSION['email'];

$priceInc = $_GET['priceInc'];

if($login == false) {
    header("Location: login.php");
    exit();
} else {
    //Information for database input for the orders
    $date = date("Y-m-d");

    $queryOrder = "INSERT INTO orders (user_id, subTotal, date)
                        VALUES('$user_id', '$priceInc', '$date')";
    $resultOrder = mysqli_query($db, $queryOrder);

    if ($resultOrder) {
        $successOrder = "De bestelling in orders is verwerkt!";
    } else {
        $errors['db'] = mysqli_error($db);
    }


    //Information for the database input about the details of the orders
        //Query for getting the order id
    $queryOrder = "SELECT id FROM orders WHERE user_id = '$user_id' ORDER BY id DESC"
        or die('Error '.mysqli_error($db).' with query '.$queryOrder);

    $resultOrderId = mysqli_query($db, $queryOrder)
        or die('Error in query: '.$queryOrder);

    $order = mysqli_fetch_assoc($resultOrderId);
    $shoppingCartItems = unserialize($_COOKIE['shoppingCart']);

    $products = [];
    $quantity = [];
    $start = 0;
    $number = 0;

    //Getting all the product info for each item
    foreach($shoppingCartItems as $shoppingCartItem) {
        $itemId = $shoppingCartItems[$start]['id'];
        $itemQuantity = $shoppingCartItems[$start]['quantity'];

        $query = "SELECT * FROM garen WHERE id = '$itemId'"
        or die('Error '.mysqli_error($db).' with query '.$query);

        $result = mysqli_query($db, $query)
        or die('Error in query: '.$query);

        $products[] = mysqli_fetch_assoc($result);
        $quantity[] = $itemQuantity;
        $start += 1;
    }

    //Putting all the product info back in the order details
    foreach($products as $product) {
        $order_id = $order['id'];
        $product_id = $product['id'];
        $price_quantity = $product['price_now'];
        $quantityProduct = $quantity[$number];
        $price_total = $product['price_now'] * $quantity[$number];

        $queryProduct = "INSERT INTO order_details (order_id, product_id, price_quantity, quantity, price_total)
                            VALUES('$order_id', '$product_id', '$price_quantity', '$quantityProduct', '$price_total')";
        $resultProduct = mysqli_query($db, $queryProduct);

        $number += 1;

        if ($resultProduct) {
            $successProduct = "Het product is opgeslagen in orderDetails!";
        } else {
            $errors['db'] = mysqli_error($db);
        }
    }

    require 'includes/mail.php';

    //Empty cookie after the order is complete
    setcookie('shoppingCart', "", time() - 3600);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Huissteden - Bestellen</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>

<body>
<header>
    <a href="index.php"><img src="images/logo_header.png"></a>
    <nav class="mainnav">
        <div><a href="index.php">Home</a></div>
        <div>Over ons</div>
        <div>Workshops</div>
        <div>Contact</div>
        <div></div>
        <div></div>
        <div>
            <?php if($login) {?>
                <a href="logout.php">Log uit</a>
            <?php } else {?>
                <a href="login.php">Log in</a>
            <?php } ?>
        </div>
        <div><a href="shoppingCart.php">Winkelmandje</a></div>
    </nav>
    <nav class="subnav">
        <div>Machines</div>
        <div>Software</div>
        <div><a href="garen.php">Garen</a></div>
        <div>Accesoires</div>
        <div>Scan 'n cut</div>
    </nav>
</header>

<main>
    <section>
        <h1>Bedankt voor uw bestelling!</h1>
        <p>U ontvangt dadelijk een bevestigings mail.</p>
    </section>

    <br>
    <br>

    <div>
        <a href="index.php" class="box">Verder met winkelen</a>
    </div>
</main>
</body>
</html>