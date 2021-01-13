<?php
require_once 'includes/database.php';
/** @var array $products */
/** @var $db */

session_start();

if(isset($_SESSION['login'])) {
    $login = $_SESSION['login'];
}
else {
    $login = false;
}

if(isset($shoppingCart)) {
    $shoppingCart = [];
}

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
    <title>Garen - Van Huissteden</title>
</head>

<body id="list">
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
    <h1>Garen</h1>

    <section id="displayProducts">
        <div class="options">
            <div>
                <h3>Soorten</h3>
                <ul>
                    <li>Naaigaren</li>
                    <li>Borduurgaren</li>
                </ul>
            </div>
            <hr>
            <div>
                <h3>Merken</h3>
                <ul>
                    <li>Ariadna</li>
                    <li>Gütermann</li>
                    <li>Madeira</li>
                    <li>Mettler</li>
                </ul>
            </div>
            <hr>
            <div>
                <h3>Kleur</h3>
                <ul>
                    <li>Zwart</li>
                    <li>Wit</li>
                    <li>Grijs</li>
                </ul>
            </div>
            <hr>
            <div>
                <h3>Prijs</h3>
            </div>
        </div>

        <div id="container">
            <div class="products">
                <?php foreach ($products as $product) { ?>
                    <div class="product">
                        <div class="photo">
                            <a href="details.php?id=<?= $product['id'] ?>">
                                <img src="images/<?= $product['picture_name'] ?>" alt="<?= $product['name'] ?>"/>
                            </a>
                        </div>
                        <div class="info">
                            <a href="details.php?id=<?= $product['id'] ?>"><?= $product['name'] ?></a>
                            <br>
                            <?= $product['price_from'] ?><strong>€ <?= $product['price_now'] ?></strong>
                        </div>
                        <div class="links">
                            <a class="detail" href="details.php?id=<?= $product['id'] ?>">Meer</a>
                            <a class="order" href="cookie.php?id=<?= $product['id'] ?>&quantity=1">Bestel</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
</main>

<footer>

</footer>
</body>
</html>
