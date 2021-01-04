<?php
require_once 'includes/database.php';
/** @var array $products */
/** @var $db */

$query = "SELECT * FROM garen";
$result = mysqli_query($db, $query);

$products = [];
while($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
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
    <title>Admin - Producten</title>
</head>

<body>
<header>
    <nav>
        <div><a href="admin.php">Ga terug</a></div>
    </nav>
</header>

<main>
    <h1>
        Producten
    </h1>

    <p>
        <a href="createProduct.php">Voeg product toe</a>
    </p>

    <table>
        <thead>
        <tr>
            <th></th>
            <th>Naam</th>
            <th>Prijs van</th>
            <th>Prijs nu</th>
            <th>Beschrijving</th>
            <th>Voorraad</th>
            <th></th>
            <th></th>
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
                <td><?= $product['price_from'] ?></td>
                <td><?= $product['price_now'] ?></td>
                <td><?= $product['description'] ?></td>
                <td><?= $product['stock'] ?></td>
                <td><a href="editProduct.php?id=<?= $product['id'] ?>">Bewerken</a></td>
                <td><a href="deleteProduct.php?id=<?= $product['id'] ?>">Verwijderen</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</main>

<footer>

</footer>
</body>
</html>
