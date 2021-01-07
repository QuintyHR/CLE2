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

$product['id'] = $id;
$product['quantity'] = $productQuantity;

$products = $_SESSION['products'];

unset($_SESSION['products']);

session_unset();
session_destroy();


$product = 'ariadna2800';

setcookie('shoppingCart', $product, time() + 3600);

$shoppingCartItem = $_COOKIE['shoppingCart'];

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
    <a href="index.html"><img src="images/logo_header.png"></a>
    <nav class="mainnav">
        <div><a href="index.html">Home</a></div>
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

    <table>
        <thead>
        <tr>
            <th></th>
            <th>Product</th>
            <th>Prijs p.s.</th>
            <th>Aantal</th>
            <th>Prijs</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <td colspan="8">&copy; Huissteden 2020</td>
        </tr>
        </tfoot>

        <tbody>
        <?php foreach ($products as $product) { ?>
            <tr>
                <td class="image"><img src="images/<?= $product['picture_name'] ?>" alt=""/></td>
                <td><?= $product['name'] ?></td>
                <td><?= $product['price_now'] ?></td>
                <td><?= $product['productQuantity'] ?></td>
                <td><?= $product['price_now'] * $productQuantity?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <a href="order.php">Bestellen</a>
</main>

<footer>

</footer>
</body>
</html>