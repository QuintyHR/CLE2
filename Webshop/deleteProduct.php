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

$productId = $_GET['id'];

$query = "DELETE FROM garen WHERE id = '$productId'";
$result = mysqli_query($db, $query);
$album = mysqli_fetch_assoc($result);

mysqli_close($db);
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
<p><a href="databaseProducts.php">Terug naar de lijst</a></p>

</body>
</html>
