<?php
require_once 'includes/database.php';
/** @var $db */

//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $firstname = mysqli_escape_string($db, $_POST['firstname']);
    $surname = mysqli_escape_string($db, $_POST['surname']);
    $street = mysqli_escape_string($db, $_POST['street']);
    $housenumber = mysqli_escape_string($db, $_POST['housenumber']);
    $city = mysqli_escape_string($db, $_POST['city']);
    $postalcode = mysqli_escape_string($db, $_POST['postalcode']);
    $country = mysqli_escape_string($db, $_POST['country']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    //Secure the data above
    $user = [
        'firstname' => $firstname,
        'surname' => $surname,
        'street' => $street,
        'housenumber' => $housenumber,
        'city' => $city,
        'postalcode' => $postalcode,
        'country' => $country,
        'email' => $email,
        'password' => $password
    ];

    //Check if data is valid & generate error if not so
    $errors = [];
    if ($firstname == "") {
        $errors['firstname'] = 'Het veldnaam Voornaam mag niet leeg zijn';
    }
    if ($surname == "") {
        $errors['surname'] = 'Het veldnaam Achternaam mag niet leeg zijn';
    }
    if ($street == "") {
        $errors['street'] = 'Het veldnaam Straat mag niet leeg zijn';
    }
    if ($housenumber == "") {
        $errors['housenumber'] = 'Het veldnaam Huisnummer mag niet leeg zijn';
    }
    if ($city == "") {
        $errors['city'] = 'Het veldnaam Woonplaats mag niet leeg zijn';
    }
    if ($postalcode == "")  {
        $errors['postalcode'] = 'Het veldnaam Postcode mag niet leeg zijn';
    }
    if ($country == "")  {
        $errors['country'] = 'Het veldnaam Land mag niet leeg zijn';
    }
    if ($email == "")  {
        $errors['email'] = 'Het veldnaam E-mailadres mag niet leeg zijn';
    }
    if ($password == "")  {
        $errors['password'] = 'Het veldnaam Wachtwoord mag niet leeg zijn';
    }

    if(empty($errors)) {
        // Now this data can be stored in de database
        $query = "INSERT INTO users (firstname, surname, street, housenumber, city, postalcode, country, email, password)
                    VALUES('$firstname', '$surname', '$street', '$housenumber', '$city', '$postalcode', '$country', '$email', '$password')";
        $result = mysqli_query($db, $query);

        if ($result) {
            $success = "Je account is aangemaakt!";
        }
        else {
            $errors['db'] = mysqli_error($db);
        }
    }
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
    <title>Nieuw account - Van Huissteden</title>
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
    <h1>Maak een nieuw account aan</h1>

    <?php if(isset($success)) { ?>
        <p>Uw account is aangemaakt! Ga terug om in te kunnen loggen.</p>
    <?php } else { ?>
        <form action= "" method="post">
            <section id="newAccount">
                <section class="data">
                    <h4>Persoonsgegevens</h4>
                    <span class="errors"><?= isset($errors['firstname']) ? $errors['firstname'] : '' ?></span>
                    <div class="data-field">
                        <label for="firstname">Voornaam</label>
                        <br>
                        <input id="firstname" type="text" name="firstname"
                               value="<?= htmlentities(isset($firstname) ? $firstname : '') ?>"/>
                    </div>
                    <br>
                    <span class="errors"><?= isset($errors['surname']) ? $errors['surname'] : '' ?></span>
                    <div class="data-field">
                        <label for="surname">Achternaam</label>
                        <br>
                        <input id="surname" type="text" name="surname"
                               value="<?= htmlentities(isset($surname) ? $surname : '') ?>"/>
                    </div>
                    <br>
                    <span class="errors"><?= isset($errors['street']) ? $errors['street'] : '' ?></span>
                    <div class="data-field">
                        <label for="street">Straat</label>
                        <br>
                        <input id="street" type="text" name="street"
                               value="<?= htmlentities(isset($street) ? $street : '') ?>"/>
                    </div>
                    <br>
                    <span class="errors"><?= isset($errors['housenumber']) ? $errors['housenumber'] : '' ?></span>
                    <div class="data-field">
                        <label for="housenumber">Huisnummer</label>
                        <br>
                        <input id="housenumber" type="text" name="housenumber"
                               value="<?= htmlentities(isset($housenumber) ? $housenumber : '') ?>"/>
                    </div>
                    <br>
                    <span class="errors"><?= isset($errors['city']) ? $errors['city'] : '' ?></span>
                    <div class="data-field">
                        <label for="city">Woonplaats</label>
                        <br>
                        <input id="city" type="text" name="city"
                               value="<?= htmlentities(isset($city) ? $city : '') ?>"/>
                    </div>
                    <br>
                    <span class="errors"><?= isset($errors['postalcode']) ? $errors['postalcode'] : '' ?></span>
                    <div class="data-field">
                        <label for="postalcode">Postcode</label>
                        <br>
                        <input id="postalcode" type="text" name="postalcode"
                               value="<?= htmlentities(isset($postalcode) ? $postalcode : '') ?>"/>
                    </div>
                    <br>
                    <span class="errors"><?= isset($errors['country']) ? $errors['country'] : '' ?></span>
                    <div class="data-field">
                        <label for="country">Land</label>
                        <br>
                        <input id="country" type="text" name="country"
                               value="<?= htmlentities(isset($country) ? $country : '') ?>"/>
                    </div>
                    <br>
                    <br>
                </section>

                <section class="signData">
                    <h4>Inloggegevens</h4>
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
                        <input id="password" type="password" name="password" minlength="8">
                    </div>
                    <br>
                    <br>

                    <div class="data-submit">
                        <input type="submit" name="submit" value="Maak account"/>
                    </div>
                </section>
            </section>
        </form>
    <?php } ?>

    <br>
    <a href="login.php">Ga terug</a>
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
