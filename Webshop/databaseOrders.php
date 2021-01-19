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

$query = "SELECT orders.*, users.firstname, users.surname FROM orders 
            INNER JOIN users ON orders.user_id = users.id
            ORDER BY orders.id DESC "
    or die('Error '.mysqli_error($db).' with query '.$query);

$result = mysqli_query($db, $query)
    or die('Error in query: '.$query);

$orders = [];
while($row = mysqli_fetch_assoc($result)) {
    $orders[] = $row;
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

    <table>
        <thead>
        <tr>
            <th>Ordernummer</th>
            <th>Klantnummer</th>
            <th>Klantnaam</th>
            <th>Totaalprijs</th>
            <th>Datum</th>
            <th></th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($orders as $order) { ?>
            <tr>
                <td>#<?= $order['id'] ?></td>
                <td>#<?= $order['user_id'] ?></td>
                <td><?= $order['firstname'] ?> <?= $order['surname'] ?></td>
                <td>€ <?= $order['subTotal'] ?></td>
                <td><?= $order['date'] ?></td>
                <td><a href="orderInfo.php?id=<?= $order['id'] ?>&user=<?= $order['user_id'] ?>">Informatie</a></td>
                <td><a href="orderDelete.php?id=<?= $order['id'] ?>">Verwijder</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</main>

<footer>

</footer>
</body>
</html>
