<?php
$products = [];

$id = $_GET['id'];
$quantity = $_GET['quantity'];

$product = [
    'id' => $id,
    'quantity' => $quantity
];

if(isset($_COOKIE['shoppingCart'])) {
//    $products = explode(",", $_COOKIE['shoppingCart']);
    $products = unserialize($_COOKIE['shoppingCart']);
}

//$products [] = $id;

$products[] = $product;
setcookie('shoppingCart', serialize($products), time() + 3600);

header("Location: garen.php");
exit();