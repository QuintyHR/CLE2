<?php
if(isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];

    $errors = [];
    if($firstname == '') {
        $errors['firstname'] = 'Het veldnaam met Voornaam mag niet leeg zijn.';
    }
    if($surname == '') {
        $errors['surname'] = 'Het veldnaam met Achternaam mag niet leeg zijn.';
    }

    if(empty($errors))
    {
        // Now this data can be stored in de database

    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Huissteden - Bestellen</title>
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
    <section>
        <h1>Bestellen</h1>
            <form action= "" method="post">

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

            <br>

            <div class="data-submit">
                <input type="submit" name="submit" value="Bestellen"/>
            </div>
        </form>
    </section>

    <br>
    <br>

    <div>
        <a href="index.html" class="box">Verder met winkelen</a>
    </div>
</main>
</body>
</html>