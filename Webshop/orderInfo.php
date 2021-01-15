<?php
require_once 'includes/database.php';
/** @var $db */

session_start();

$login = $_SESSION['login'];
$admin = $_SESSION['admin'];

if($admin != 1 || $login == false) {
    header("Location: login.php");
    exit();
}

$index = $_GET['id'];
$user_id = $_GET['user'];
$totalPrice = 4.95;


//query for order information
$queryProducts = "SELECT order_details.*, garen.picture_name, garen.name FROM order_details
            INNER JOIN garen ON order_details.product_id = garen.id
            WHERE order_details.order_id = '$index'"
or die('Error '.mysqli_error($db).' with query '.$queryProducts);

$resultProducts = mysqli_query($db, $queryProducts)
or die('Error in query: '.$queryProducts);

$order_details = [];
while($row = mysqli_fetch_assoc($resultProducts)) {
    $order_details[] = $row;
}

//query for user information
$query = "SELECT * FROM users WHERE id = '$user_id'"
or die('Error '.mysqli_error($db).' with query '.$query);

$result = mysqli_query($db, $query)
or die('Error in query: '.$query);

$user = mysqli_fetch_assoc($result);


mysqli_close($db);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <title>Info Bestelling - Van Huissteden</title>
</head>

<body>
<header>
    <nav>
        <div><a href="databaseOrders.php">Ga terug</a></div>
    </nav>
</header>

<main>
    <h1>Bestelling #<?= $index?></h1>

    <section id="displayOrderDetails">
        <div class="orderProducts">
            <table>
                <thead>
                <tr>
                    <th></th>
                    <th>Product</th>
                    <th>Prijs p.s.</th>
                    <th>Aantal</th>
                    <th>Totaal</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($order_details as $order_detail) { ?>
                    <tr>
                        <td class="imageShopping"><img src="images/<?= $order_detail['picture_name'] ?>" alt=""/></td>
                        <td><?= $order_detail['name'] ?></td>
                        <td>€ <?= $order_detail['price_quantity'] ?></td>
                        <td><?= $order_detail['quantity'] ?></td>
                        <td>€ <?= $order_detail['price_total'] ?></td>
                    </tr>
                <?php
                    $totalPrice += $order_detail['price_total'];
                    $totalPrice = number_format($totalPrice, "2");
                    }
                ?>
                </tbody>
            </table>
        </div>

        <div class="orderInformation">
            <div class="orderListSummary">
                <h2>Overzicht</h2>
            </div>
            <p>Klantnaam: <?= $user['firstname'] ?> <?= $user['surname'] ?></p>
            <p>Adres: <?= $user['street'] ?> <?= $user['housenumber'] ?></p>
            <p>Plaats: <?= $user['city'] ?></p>
            <p>Postcode: <?= $user['postalcode'] ?></p>
            <p>Land: <?= $user['country'] ?></p>
            <p>E-mail: <?= $user['email'] ?></p>
            <br>
            <p>Totaalprijs: € <?= $totalPrice ?></p>
        </div>
    </section>

    <section>

    </section>
</main>

<footer>

</footer>
</body>
</html>
