<?php
// Include data (all albums)
require_once 'musicData.php';
/** @var array $albums */

// IF index is not present in url or value is empty
if(!isset($_GET['music']) || $_GET['music'] == '') {
    // redirect to index.html
    header( 'Location: index.html');
    exit;
}

// Get index of album from url (GET)
$index = $_GET['music'];

// get album from albums collection
$album = $albums[$index];
?>

<!doctype html>
<html lang="en">
<head>
    <title>Music Collection - Details <?= $albums['album'] ?></title>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>
<section>
    <h1><?= $album['artist'] . ' - ' . $album['album'] ?></h1>
    <ul>
        <li>Genre: <?= $album['genre'] ?></li>
        <li>Year: <?= $album['year'] ?></li>
        <li>Tracks: <?= $album['tracks'] ?></li>
    </ul>
</section>

<div>
    <a href="index.php">Go back to the list</a>
</div>
</body>
</html>
