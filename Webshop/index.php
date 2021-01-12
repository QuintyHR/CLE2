<?php
session_start();

if(isset($_SESSION['login'])) {
    $login = $_SESSION['login'];
}
else {
    $login = false;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <title>Van Huissteden - Speciaal zaak</title>
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
    <section class="transbox">
        <h1>
            Van Huissteden - Webshop
            <br>
            <br>
            Hét adres voor naai-, borduur- en lockmachines
        </h1>
        <h2>
            Verkoop, reparatie & onderhoud
            <br>
            <br>
            <br>
            Coronavirus
            <br>
            De gezondheid van onze bezoekers en medewerksters staat voor op.
            <br>
            Hierbij zijn er enkele maatregelen getroffen, ook via de richtlijnen vanuit het RIVM
            <br>
            <br>
            - We schudden geen handen
            <br>
            - We houden 1.5 meter afstand van elkaar
            <br>
            - Gelieve aan de kassa met de pin betalen, als dit niet anders kan,
            <br>
            - Het contant geld op de balie leggen, en niet in de hand.
        </h2>
    </section>
</main>

<footer>

</footer>
</body>
</html>
