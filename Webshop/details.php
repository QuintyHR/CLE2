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
    <section class="advantages">
        <br>
        <h1>Onze voordelen</h1>
        <br>
        <section class="advantagesContainer">
            <section class="shipping">
                <img src="icons/shipping.png"/>
                <h2>Geen verzendkosten</h2>
                <p>Bij bestellingen boven de € 50,-</p>
                <p>Onder de € 50,- vanaf € 1,95</p>
            </section>

            <section class="retour">
                <img src="icons/retour.png"/>
                <h2>Gratis retour</h2>
                <p>Tot 14 dagen gratis retourneren of annuleren</p>
            </section>

            <section class="ownStock">
                <img src="icons/ownStock.png"/>
                <h2>Uit eigen voorraad</h2>
                <p>Snel geleverd uit eigen voorraad</p>
            </section>

            <section class="payment">
                <img src="icons/payment.png"/>
                <h2>Veilig betalen</h2>
                <p>Met iDeal</p>
            </section>
        </section>
        <br>
    </section>

    <section class="footer">
        <br>
        <section class="schedule">
            <h2 class="schedule">Openingstijden</h2>
            <div></div>
            <p class="schedule">Ma: 13.00 - 18.00 uur</p>
            <p class="schedule">Di t/m vr: 09.00 - 18.00 uur</p>
            <p class="schedule">Za: 09.00 - 17.00 uur</p>
            <br>
            <p class="schedule">Zon- en feestdagen gesloten!</p>
            <p class="schedule">Gratis parkeren voor de deur.</p>
        </section>

        <section class="contact">
            <h2 class="contact">Contactgegevens</h2>
            <div></div>
            <p class="contact">van Huissteden</p>
            <p class="contact">Nedereindseweg 37</p>
            <p class="contact">3438 AA Nieuwegein</p>
            <p class="contact">tel.: 030 - 60 44 998</p>
            <p class="contact">info@huissteden.com</p>
        </section>

        <section class="newsletter">
            <h2 class="newsletter">Nieuwsbrief</h2>
            <div></div>
            <p class="newsletter">Wees als eerste op de hoogte van nieuws en aanbiedingen!</p>
        </section>
        <br>
    </section>

    <section class="copyright">
        <p class="copyright">© Huissteden 2021. Alle rechten voorbehouden.</p>
        <br>
    </section>
</footer>
</body>
</html>
