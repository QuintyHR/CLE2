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

if(!isset($quantity)) {
    $quantity = 1;
}

$index = $_GET['id'];

$query = "SELECT * FROM garen WHERE id = '$index'"
    or die('Error '.mysqli_error($db).' with query '.$query);

$result = mysqli_query($db, $query)
    or die('Error in query: '.$query);

$product = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $quantity = $_POST['quantity'];
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
            <div>
                <p><?= $product['description'] ?></p>
            </div>
            <div>
                <p><strong>€ <?= $product['price_now'] ?></strong></p>
            </div>
            <div>
                <p>Beschikbaarheid: <?= $product['stock'] ?></p>
            </div>

            <br>

            <div class="orderCartAlign">
                <form action="cookie.php?id=<?= $product['id'] ?>&quantity=<?= $quantity ?>">
                    <input id="id" type="hidden" name="id" value="<?= $product['id'] ?>">
                    <input id="quantity" type="number" name="quantity" value="<?= $quantity ?>"/>

                    <input type="submit" name="submit" value="Bestel" class="button"/>
                </form>
            </div>
            <br>
            <br>
            <a href="garen.php">Ga terug</a>
        </section>
    </section>
</main>

<footer>

</footer>
</body>
</html>
