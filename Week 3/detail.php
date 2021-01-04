<?php
//Require music data to use the db variable in this file
require_once 'includes/database.php';
/** @var $db */

// Get index of album from url (GET)
$index = $_GET['index'];

// create a query to select the album from the database
$query = "SELECT * FROM albums WHERE id = '$index'"
    or die('Error '.mysqli_error($db).' with query '.$query);

// execute the query on the db
$result = mysqli_query($db, $query)
    or die('Error in query: '.$query);

// If all goes well, the db returns a table result with 1 row

// Fetch the row
$album = mysqli_fetch_assoc($result);

// Close the db connection
mysqli_close($db);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $album['album'] ?></title>
</head>
<body>
<img src="images/<?= $album['image'] ?>" alt=""/>
<section>
    <h1><?= $album['artist'] . ' - ' . $album['album'] ?></h1>
    <ul>
        <li>Genre: <?= $album['genre'] ?></li>
        <li>Year: <?= $album['year'] ?></li>
        <li>Tracks: <?= $album['tracks'] ?></li>
    </ul>
</section>
</body>
</html>

