<?php
$firstname = $_POST['firstname'];
$surname = $_POST['surname'];
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
    <nav>
        <div><a href="index.html">Home</a></div>
        <div><a href="garen.php">Producten</a></div>
        <div>Over ons</div>
        <div>Workshops</div>
        <div>Contact</div>
    </nav>
</header>

<main>
    Bedankt voor je bestelling <?= $firstname; ?>
</main>

<footer>

</footer>
</body>
</html>
