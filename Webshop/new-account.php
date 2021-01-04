<?php

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nieuw account - Van Huissteden</title>
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
    <h1>Maak een nieuw account aan</h1>

    <form action= "" method="post">
        <h4>Persoonsgegevens</h4>
        <span class="errors"><?= isset($errors['firstname']) ? $errors['firstname'] : '' ?></span>
        <div class="data-field">
            <label for="firstname">Voornaam</label>
            <input id="firstname" type="text" name="firstname"
                   value="<?= isset($firstname) ? $firstname : '' ?>"/>
        </div>
        <span class="errors"><?= isset($errors['surname']) ? $errors['surname'] : '' ?></span>
        <div class="data-field">
            <label for="surname">Achternaam</label>
            <input id="surname" type="text" name="surname"
                   value="<?= isset($surname) ? $surname : '' ?>"/>
        </div>
        <span class="errors"><?= isset($errors['street']) ? $errors['street'] : '' ?></span>
        <div class="data-field">
            <label for="street">Straat</label>
            <input id="street" type="text" name="street"
                   value="<?= isset($street) ? $street : '' ?>"/>
        </div>
        <span class="errors"><?= isset($errors['housenumber']) ? $errors['housenumber'] : '' ?></span>
        <div class="data-field">
            <label for="housenumber">Huisnummer</label>
            <input id="housenumber" type="text" name="housenumber"
                   value="<?= isset($housenumber) ? $housenumber : '' ?>"/>
        </div>
        <span class="errors"><?= isset($errors['city']) ? $errors['city'] : '' ?></span>
        <div class="data-field">
            <label for="city">Woonplaats</label>
            <input id="city" type="text" name="city"
                   value="<?= isset($city) ? $city : '' ?>"/>
        </div>
        <span class="errors"><?= isset($errors['postalcode']) ? $errors['postalcode'] : '' ?></span>
        <div class="data-field">
            <label for="postalcode">Postcode</label>
            <input id="postalcode" type="text" name="postalcode"
                   value="<?= isset($postalcode) ? $postalcode : '' ?>"/>
        </div>
        <span class="errors"><?= isset($errors['country']) ? $errors['country'] : '' ?></span>
        <div class="data-field">
            <label for="country">Land</label>
            <input id="country" type="text" name="country"
                   value="<?= isset($country) ? $country : '' ?>"/>
        </div>

        <br>

        <h4>Inloggegevens</h4>
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
            <input type="submit" name="submit" value="Maak account"/>
        </div>
    </form>

    <br>

    <a href="login.php">Ga terug</a>
</main>

<footer>

</footer>
</body>
</html>
