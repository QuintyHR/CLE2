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

$orderId = $_GET['id'];

$queryOrder = "DELETE FROM orders WHERE id = $orderId";
$resultOrder = mysqli_query($db, $queryOrder);
$order = mysqli_fetch_assoc($resultOrder);

$queryDetails = "DELETE FROM order_details WHERE order_id = $orderId";
$resultDetails = mysqli_query($db, $queryDetails);
$details = mysqli_fetch_assoc($resultDetails);

mysqli_close($db);

header("Location: databaseOrders.php");
exit();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h1>Het product is succesvol verwijderd</h1>
<p><a href="databaseOrders.php">Terug naar de lijst</a></p>

</body>
</html>
