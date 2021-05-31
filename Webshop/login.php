<?php
require_once 'includes/database.php';
/** @var $db */

session_start();

$login = false;

if (isset($_POST['submit'])) {
    $email = mysqli_escape_string($db, $_POST['email']);
    $password = $_POST['password'];

    $errors = [];
    if ($email == "") {
        $errors['email'] = 'Het e-mailadres moet nog worden ingevuld';
    }
    if ($password == "") {
        $errors['password'] = 'Het wachtwoord moet nog worden ingevuld';
    }

    //Get record from DB based on email
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $login = true;
            $_SESSION['userId'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['surname'] = $user['surname'];
            $_SESSION['admin'] = $user['admin'];
        }
        else {
            //error onjuiste logingegevens
            $login = false;
            $errors['combination'] = 'Uw login gegevens zijn onjuist';
        }
    }
    else {
        //error onjuiste inloggegevens
        $login = false;
        $errors[] = 'Uw login gegevens zijn onjuist';
    }
}

$_SESSION['login'] = $login;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Van Huissteden</title>
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
    <h1>Inloggen</h1>

    <?php if ($login && $_SESSION['admin'] == 1) {
        header("Location: admin.php");
        exit();
    } elseif ($login && $_SESSION['admin'] == 0) {?>
        <p>U bent succesvol ingelogd!</p>
    <?php } else {?>
    <section id="displayLogin">
        <div class="login">
            <h4>Inloggen bestaande klanten</h4>

            <form action= "" method="post">
                <span class="errors"><?= isset($errors['combination']) ? $errors['combination'] : '' ?></span>
                <span class="errors"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
                <div class="data-field">
                    <label for="email">E-mailadres</label>
                    <br>
                    <input id="email" type="text" name="email"
                           value="<?= htmlentities(isset($email) ? $email : '') ?>"/>
                </div>
                <br>
                <span class="errors"><?= isset($errors['password']) ? $errors['password'] : '' ?></span>
                <div class="data-field">
                    <label for="password">Wachtwoord</label>
                    <br>
                    <input id="password" type="password" name="password"/>
                </div>

                <br>
                <br>

                <div class="data-submit">
                    <input type="submit" name="submit" value="Login"/>
                </div>
            </form>
        </div>

        <div class="new-account">
            <h4>Een nieuw account aanmaken</h4>
            <p>Nog geen account bij Van Huissteden? Maak dan hier en gemakklijk een nieuw account aan om sneller te bestellen en vorige bestellingen terug te vinden.</p>
            <a href="new-account.php">Maak nieuw account aan</a>
        </div>
    </section>
    <?php } ?>

    <br>
    <br>
    <a href="index.php">Ga terug</a>
    <br>
    <br>
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
