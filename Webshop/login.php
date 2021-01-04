<?php

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
        <div>Winkelmandje</div>
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

    <section id="displayLogin">
        <div class="login">
            <h4>Inloggen bestaande klanten</h4>

            <form action= "" method="post">
                <span class="errors"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
                <div class="data-field">
                    <label for="email">E-mailadres</label>
                    <input id="email" type="text" name="email"
                           value="<?= isset($email) ? $email : '' ?>"/>
                </div>
                <span class="errors"><?= isset($errors['password']) ? $errors['password'] : '' ?></span>
                <div class="data-field">
                    <label for="password">Wachtwoord</label>
                    <input id="password" type="text" name="password"
                           value="<?= isset($password) ? $password : '' ?>"/>
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

    <br>

    <a href="index.html">Ga terug</a>
</main>

<footer>
    
</footer>
</body>
</html>
