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
            <h2>Zoek opties</h2>
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
                            <a class="detail" href="details.php?id=<?= $product['id'] ?>">Meer info</a>
                            <a class="order" href="cookie.php?id=<?= $product['id'] ?>&quantity=1">Bestel</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
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
