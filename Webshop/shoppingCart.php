<?php
require_once 'includes/database.php';
/** @var $db */

session_start();

if(isset($_SESSION['login']) && isset($_SESSION['userId'])) {
    $login = $_SESSION['login'];
    $user_id = $_SESSION['userId'];
}
else {
    $login = false;
}

if(isset($_COOKIE['shoppingCart'])) {
    $shoppingCartItems = unserialize($_COOKIE['shoppingCart']);

    $products = [];
    $quantity = [];
    $start = 0;
    $number = 0;

    foreach($shoppingCartItems as $shoppingCartItem) {
        $itemId = $shoppingCartItems[$start]['id'];
        $itemQuantity = $shoppingCartItems[$start]['quantity'];

        $query = "SELECT * FROM garen WHERE id = '$itemId'"
        or die('Error '.mysqli_error($db).' with query '.$query);

        $result = mysqli_query($db, $query)
        or die('Error in query: '.$query);

        $products[] = mysqli_fetch_assoc($result);
        $quantity[] = $itemQuantity;
        $start += 1;
    }

    $shoppingCartItems = serialize($_COOKIE['shoppingCart']);
}

$priceTotal = 0;
$shippingCost = 4.95;

mysqli_close($db);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Winkelmandje - Van Huissteden</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
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
    <h1>Winkelmandje</h1>

    <br>

    <?php if(isset($products)) { ?>
    <section id="displayShoppingCart">
        <div class="shoppingList">
            <table class="shoppingList">
                <thead class="shoppingList">
                <tr>
                    <th></th>
                    <th>Product</th>
                    <th>Prijs p.s.</th>
                    <th>Aantal</th>
                    <th>Prijs</th>
                    <th></th>
                </tr>
                </thead>

                <tbody class="shoppingList">
                    <?php foreach ($products as $product) { ?>
                        <tr>
                            <td class="imageShopping"><img src="images/<?= $product['picture_name'] ?>" alt=""/></td>
                            <td><?= $product['name'] ?></td>
                            <td>€ <?= number_format($product['price_now'], "2")?></td>
                            <td class="inputQuantity">
                                <div class="inputQuantity">
                                    <input id="quantity" type="number" name="quantity"
                                           value="<?= $quantity[$number] ?>"/>
                                </div>
                            </td>
                            <td>€ <?= number_format($product['price_now'] *= $quantity[$number], "2")?></td>
                            <td class="trashCan"><img src="icons/trashCan.png"></td>
                        </tr>
                    <?php
                        $number += 1;
                        $priceTotal += $product['price_now'];
                        $priceTotal = number_format($priceTotal, "2");
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="orderList">
            <div class="orderListSummary">
                <h2>Overzicht</h2>
            </div>
            <p>Subtotaal: € <?= $priceTotal ?></p>
            <p>Verzendkosten: € <?= $shippingCost ?></p>
            <?php
                $priceInc = $priceTotal + $shippingCost;
                $priceInc = number_format($priceInc, "2");
            ?>
            <p>Totaal: € <?= $priceInc?></p>
            <br>
            <form action="order.php">
                <input type="hidden" name="priceInc" value="<?= $priceInc?>">
                <div class="orderCartAlign">
                    <input type="submit" name="submit" value="Plaats bestelling" class="button"/>
                </div>
            </form>
        </div>
        <br>
        <br>
    </section>

    <?php } else { ?>
    <section>
        <p>Uw winkelmandje is nog leeg</p>
        <br>
        <div>
            <a href="index.php" class="box">Verder met winkelen</a>
        </div>
        <br>
        <br>
    </section>
    <?php } ?>
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