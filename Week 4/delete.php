<?php
require_once 'includes/database.php';
/** @var $db */

$albumId = $_GET['id'];

$query = "DELETE FROM albums WHERE id = $albumId";
$result = mysqli_query($db, $query);
$album = mysqli_fetch_assoc($result);

mysqli_close($db);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h1>Het album is succesvol verwijderd</h1>
<p><a href="index.php">Terug naar de lijst</a></p>

</body>
</html>
