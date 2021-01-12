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

$index = $_GET['id'];

$query = "SELECT * FROM garen WHERE id = '$index'"
    or die('Error '.mysqli_error($db).' with query '.$query);

$result = mysqli_query($db, $query)
    or die('Error in query: '.$query);

$product = mysqli_fetch_assoc($result);

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
    <title>Huissteden - <?= $product['name']?></title>
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
    <h1><?= htmlentities($product['name'])?></h1>

    <section id="displayDetails">
        <div class="detailPhoto">
            <img src="images/<?= $product['picture_name'] ?>" alt="<?= $product['name'] ?>"/>
        </div>

        <section id="">
            <h2><?= $product['name']?></h2>
            <ul>
                <li>Beschrijving: <?= $product['description'] ?></li>
                <li>Prijs: € <?= $product['price_now'] ?></li>
                <li>Voorraad: <?= $product['stock'] ?></li>
            </ul>
            <div class="links">
                <a class="orderDetails" href="cookie.php?id=<?= $product['id'] ?>">Bestel</a>
            </div>
            <br>
            <a href="garen.php">Ga terug</a>
        </section>
    </section>
</main>
</body>

</html>
