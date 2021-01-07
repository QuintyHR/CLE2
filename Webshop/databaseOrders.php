<?php
require_once 'includes/database.php';
/** @var array $products */
/** @var $db */

session_start();

$login = $_SESSION['login'];
$admin = $_SESSION['admin'];

if($admin != 1 || $login == false) {
    header("Location: login.php");
    exit();
}

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
    <title>Bestellingen overzicht</title>
</head>

<body>
<header>
    <nav>
        <div><a href="admin.php">Ga terug</a></div>
    </nav>
</header>

<main>
    <h1>Bestellingen overzicht</h1>
</main>

<footer>

</footer>
</body>

<footer>
</footer>

</html>
