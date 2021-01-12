<?php
require_once 'includes/database.php';
/** @var $db */

session_start();

if(isset($_SESSION['login'])) {
    $login = $_SESSION['login'];
}
else {
    $login = false;
}

//$shoppingCartItems = explode(",", $_COOKIE['shoppingCart']);
if(isset($_COOKIE['shoppingCart'])) {
    $shoppingCartItems = $_COOKIE['shoppingCart'];

    $query = "SELECT * FROM garen WHERE id IN ($shoppingCartItems)"
    or die('Error '.mysqli_error($db).' with query '.$query);

    $result = mysqli_query($db, $query)
    or die('Error in query: '.$query);

    $products = [];
    while($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
}

$priceTotal = 0;
$shippingCost = 4.95;

mysqli_close($db);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Winkelmadje - Van Huissteden</title>
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
    <h1>Winkelmandje</h1>

    <br>

    <?php if(isset($products)) { ?>
    <section id="displayShoppingCart">
        <div class="shoppingList">
            <table class="shoppingList">
                <thead class="shoppingList">
                <tr>
                    <th></th>
                    <th>Product</th>
                    <th>Prijs p.s.</th>
                    <th>Aantal</th>
                    <th>Prijs</th>
                    <th></th>
                </tr>
                </thead>

                <tbody class="shoppingList">
                <?php foreach ($products as $product) { ?>
                    <tr>
                        <td class="imageShopping"><img src="images/<?= $product['picture_name'] ?>" alt=""/></td>
                        <td><?= $product['name'] ?></td>
                        <td>€ <?= $product['price_now'] ?></td>
                        <td></td>
                        <td>€ </td>
                        <td>Verwijder</td>
                    </tr>
                <?php
                    $priceTotal += $product['price_now'];
                    $priceTotal = number_format($priceTotal, "2");
                    }
                ?>
                </tbody>
            </table>
        </div>

        <div class="orderList">
            <p>Subtotaal: € <?= $priceTotal ?></p>
            <p>Verzendkosten: € <?= $shippingCost ?></p>
            <?php
                $priceInc = $priceTotal + $shippingCost;
                $priceInc = number_format($priceInc, "2");
            ?>
            <p>Totaal: € <?= $priceInc?></p>
            <div class="links">
                <a class="orderDetails" href="order.php">Plaats bestelling</a>
            </div>
        </div>
    </section>

    <?php } else { ?>
    <section>
        <p>Uw winkelmandje is nog leeg</p>
        <br>
        <div>
            <a href="index.php" class="box">Verder met winkelen</a>
        </div>
    </section>
    <?php } ?>
</main>

<footer>

</footer>
</body>
</html>