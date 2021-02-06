<?php
//Require music data to use variable in this file
require_once "includes/database.php";
/** @var $db */

session_start();

$login = $_SESSION['login'];
$admin = $_SESSION['admin'];

if($admin != 1 || $login == false) {
    header("Location: login.php");
    exit();
}

//TODO: Handle POST data & store in DB
if (isset($_POST['submit'])) {
    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $name = mysqli_escape_string($db, $_POST['name']);
    $price_from = mysqli_escape_string($db, $_POST['price_from']);
    $price_now = mysqli_escape_string($db, $_POST['price_now']);
    $description = mysqli_escape_string($db, $_POST['description']);
//    $picture_name = $_POST['picture_name'];
    $stock = mysqli_escape_string($db, $_POST['stock']);
    $productId = $_POST['id'];

    //Secure the data above
    $product = [
        'name' => $name,
        'price_from' => $price_from,
        'price_now' => $price_now,
        'description' => $description,
//        'picture_name' => $picture_name,
        'stock' => $stock,
        'productId' => $productId
    ];

    //Check if data is valid & generate error if not so
    $errors = [];
//    if ($picture_name == "") {
//        $errors[] = 'Er moet nog een plaatje worden toegevoegd';
//    }
    if ($name == "") {
        $errors[] = 'Het veldnaam Product naam mag niet leeg zijn';
    }
    if ($price_now == "") {
        $errors[] = 'Het veldnaam Prijs voor mag niet leeg zijn';
    }
    if ($description == "") {
        $errors[] = 'Het veldnaam Beschrijving mag niet leeg zijn';
    }
    if ($stock == "")  {
        $errors[] = 'Er is niet opgegeven of het product op voorraad is';
    }

    if(empty($errors)) {
//        if($_FILES['picture_name']['error'] != 4) {
//            deleteImageFile($picture_name);
//            $picture_name = addImageFile($_FILES['picture_name']);
//        }

        // Now this data can be stored in de database
        if($price_from == ""){
            $price_from = null;
        }

        $query = "UPDATE garen SET name = '$name', 
                                    price_now = '$price_now',
                                    description = '$description',
                                    stock = '$stock'
                    WHERE id = '" . mysqli_escape_string($db, $productId) . "'";
        $result = mysqli_query($db, $query);

        if ($result) {
            header('Location: databaseProducts.php');
            exit();
        }
        else {
            $errors['db'] = mysqli_error($db);
        }
    }
} elseif (isset($_GET['id'])) {
    //Retrieve the GET parameter from the 'Super global'
    $productId = $_GET['id'];

    $query = "SELECT * FROM garen WHERE id = $productId";
    $result = mysqli_query($db, $query)
        or die('Error'. mysqli_error($db));
    if ($result) {
        $product = mysqli_fetch_assoc($result);
    }
}

mysqli_close($db);
?>

<!doctype html>
<html lang="en">
<head>
    <title>Bewerken - Van Huissteden</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<header>

</header>

<main>
    <h1>Bewerk <?= $product['name']; ?></h1>

    <?php if (isset($errors)) { ?>
        <ul class="errors">
            <?php foreach ($errors as $error) { ?>
                <li><?= $error; ?></li>
            <?php } ?>
        </ul>
    <?php } ?>

    <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">
        <div class="data-field">
            <label for="name">Product naam</label>
            <input id="name" type="text" name="name" value="<?= $product['name']; ?>"/>
            <span class="errors"><?= (isset($errors['name']) ? $errors['name'] : '') ?></span>
        </div>

        <div class="data-field">
            <label for="price_from">Prijs van</label>
            <input id="price_from" type="text" name="price_from" value="<?= $product['price_from']; ?>"/>
        </div>

        <div class="data-field">
            <label for="price_now">Prijs voor</label>
            <input id="price_now" type="text" name="price_now" value="<?= $product['price_now']; ?>"/>
            <span class="errors"><?= (isset($errors['price_now']) ? $errors['price_now'] : '') ?></span>
        </div>

        <div class="data-field">
            <label for="description">Beschrijving</label>
            <input id="description" type="text" name="description" value="<?= $product['description']; ?>"/>
            <span class="errors"><?= (isset($errors['description']) ? $errors['description'] : '') ?></span>
        </div>

        <div class="data-field">
            <ul>
                <li>
                    <label for="stock">Op voorraad</label>
                    <input id="stock" type="radio" name="stock" value="Op voorraad"/>
                </li>
                <li>
                    <label for="stock">Niet op voorraad</label>
                    <input id="stock" type="radio" name="stock" value="Niet op voorraad"/>
                </li>
            </ul>
            <span class="errors"><?= (isset($errors['stock']) ? $errors['stock'] : '') ?></span>
        </div>

        <div class="data-submit">
            <input type="hidden" name="id" value="<?= $productId; ?>"/>
            <input type="submit" name="submit" value="Bewerk"/>
        </div>
    </form>
    <br>
    <div>
        <a href="databaseProducts.php">Ga terug naar de lijst</a>
    </div>
</main>

<footer>

</footer>
</body>
</html>
