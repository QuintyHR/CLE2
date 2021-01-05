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
        }
        else {
            //error onjuiste logingegevens
            $login = false;
            $errors['combination'] = 'De combinatie van het e-mailadres en het wachtwoord is niet bij ons bekend';
        }
    }
    else {
        //error onjuiste inloggegevens
        $login = false;
        $errors[] = 'De combinatie van het e-mailadres en het wachtwoord is niet bij ons bekend';
    }
}

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
    <a href="index.html"><img src="images/logo_header.png"></a>
    <nav class="mainnav">
        <div><a href="index.html">Home</a></div>
        <div>Over ons</div>
        <div>Workshops</div>
        <div>Contact</div>
        <div></div>
        <div></div>
        <div><a href="login.php">Log in</a></div>
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

    <?php if ($login && $user['admin'] == 1) {
        header("Location: admin.php");
        exit();

    } elseif ($login && $user['admin'] == 0) {?>
        <p>U bent succesvol ingelogd</p>
    <?php } else {?>
    <section id="displayLogin">
        <div class="login">
            <h4>Inloggen bestaande klanten</h4>

            <form action= "" method="post">
                <span class="errors"><?= isset($errors['combination']) ? $errors['combination'] : '' ?></span>
                <span class="errors"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
                <div class="data-field">
                    <label for="email">E-mailadres</label>
                    <input id="email" type="text" name="email"
                           value="<?= htmlentities(isset($email) ? $email : '') ?>"/>
                </div>
                <span class="errors"><?= isset($errors['password']) ? $errors['password'] : '' ?></span>
                <div class="data-field">
                    <label for="password">Wachtwoord</label>
                    <input id="password" type="password" name="password"/>
                </div>

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

    <a href="index.html">Ga terug</a>
</main>

<footer>
    
</footer>
</body>
</html>
