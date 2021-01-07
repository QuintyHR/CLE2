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
    <h1>Maak een nieuw account aan</h1>

    <?php if(isset($success)) { ?>
        <p>Uw account is aangemaakt! Ga terug om in te kunnen loggen.</p>
    <?php } else { ?>
    <form action= "" method="post">
        <h4>Persoonsgegevens</h4>
        <span class="errors"><?= isset($errors['firstname']) ? $errors['firstname'] : '' ?></span>
        <div class="data-field">
            <label for="firstname">Voornaam</label>
            <input id="firstname" type="text" name="firstname"
                   value="<?= htmlentities(isset($firstname) ? $firstname : '') ?>"/>
        </div>
        <span class="errors"><?= isset($errors['surname']) ? $errors['surname'] : '' ?></span>
        <div class="data-field">
            <label for="surname">Achternaam</label>
            <input id="surname" type="text" name="surname"
                   value="<?= htmlentities(isset($surname) ? $surname : '') ?>"/>
        </div>
        <span class="errors"><?= isset($errors['street']) ? $errors['street'] : '' ?></span>
        <div class="data-field">
            <label for="street">Straat</label>
            <input id="street" type="text" name="street"
                   value="<?= htmlentities(isset($street) ? $street : '') ?>"/>
        </div>
        <span class="errors"><?= isset($errors['housenumber']) ? $errors['housenumber'] : '' ?></span>
        <div class="data-field">
            <label for="housenumber">Huisnummer</label>
            <input id="housenumber" type="text" name="housenumber"
                   value="<?= htmlentities(isset($housenumber) ? $housenumber : '') ?>"/>
        </div>
        <span class="errors"><?= isset($errors['city']) ? $errors['city'] : '' ?></span>
        <div class="data-field">
            <label for="city">Woonplaats</label>
            <input id="city" type="text" name="city"
                   value="<?= htmlentities(isset($city) ? $city : '') ?>"/>
        </div>
        <span class="errors"><?= isset($errors['postalcode']) ? $errors['postalcode'] : '' ?></span>
        <div class="data-field">
            <label for="postalcode">Postcode</label>
            <input id="postalcode" type="text" name="postalcode"
                   value="<?= htmlentities(isset($postalcode) ? $postalcode : '') ?>"/>
        </div>
        <span class="errors"><?= isset($errors['country']) ? $errors['country'] : '' ?></span>
        <div class="data-field">
            <label for="country">Land</label>
            <input id="country" type="text" name="country"
                   value="<?= htmlentities(isset($country) ? $country : '') ?>"/>
        </div>

        <br>

        <h4>Inloggegevens</h4>
        <span class="errors"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
        <div class="data-field">
            <label for="email">E-mailadres</label>
            <input id="email" type="text" name="email"
                   value="<?= htmlentities(isset($email) ? $email : '') ?>"/>
        </div>
        <span class="errors"><?= isset($errors['password']) ? $errors['password'] : '' ?></span>
        <div class="data-field">
            <label for="password">Wachtwoord</label>
            <input id="password" type="password" name="password" minlength="8">
        </div>

        <br>

        <div class="data-submit">
            <input type="submit" name="submit" value="Maak account"/>
        </div>
    </form>
    <?php } ?>

    <br>

    <a href="login.php">Ga terug</a>
</main>

<footer>

</footer>
</body>
</html>
