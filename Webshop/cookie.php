<?php
$products = [];

$index = $_GET['id'];
$quantity = 1;

//$product = [
//    'id' => $index,
//    'quantity' => $quantity
//];

if(isset($_COOKIE['shoppingCart'])) {
    $products = explode(",", $_COOKIE['shoppingCart']);
}

$products [] = $index;

setcookie('shoppingCart', implode(",", $products), time() + 3600);

header("Location: garen.php");
exit();