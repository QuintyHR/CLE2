<?php
// Include data (all albums)
require_once 'musicData.php';
/** @var array $albums */

// IF index is not present in url or value is empty
$save = false;
if(isset($_POST['submit'])) {
    if($_POST['artist'] == "") {
        $artistError = "Artist mag niet leeg zijn, probeer het opnieuw!";
    }

    if($_POST['album'] == "") {
        $albumError = "Album mag niet leeg zijn, probeer het opnieuw!";
    }

    if($_POST['genre'] == "") {
        $genreError = "Genre mag niet leeg zijn, probeer het opnieuw!";
    }

    if($_POST['year'] == "") {
        $yearError = "Year mag niet leeg zijn, probeer het opnieuw!";
    }

    if($_POST['tracks'] == "") {
        $tracksError = "Tracks mag niet leeg zijn, probeer het opnieuw!";
    }

    else{
        $save =true;
    }
}

// redirect to index.html


// IF index is present


// Get index of album from url (GET)
$edit = $_GET['music'];

// get album from albums collection
if ($edit == 1){
    $edit = $albums[1];
}

if ($edit == 2){
    $edit = $albums[2];
}

if ($edit == 3){
    $edit = $albums[3];
}

if ($edit == 4){
    $edit = $albums[4];
}

if ($edit == 5){
    $edit = $albums[5];
}

if ($edit == 6){
    $edit = $albums[6];
}

if ($edit == 7){
    $edit = $albums[7];
}

if ($edit == 8){
    $edit = $albums[8];
}

if ($edit == 9){
    $edit = $albums[9];
}

if ($edit == 10){
    $edit = $albums[10];
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Music Collection - Edit <?= $edit['album'] ?></title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>
<section>
    <h1>Edit album - <?= $edit['album'] ?></h1>

    <?php if($save == true){ ?>
        <form action= "musicData.php" method="post">
    <?php }
    else { ?>
        <form action= "" method="post">
    <?php }?>

        <?php if (isset($artistError)) { ?>
            <p class="errors"><?= $artistError; ?></p>
        <?php } ?>
        <div class="data-field">
            <label for="artist">Artist</label>
            <input id="artist" type="text" name="artist" value="<?= $edit['artist'] ?>"/>
        </div>

        <?php if (isset($albumError)) { ?>
            <p class="errors"><?= $albumError; ?></p>
        <?php } ?>
        <div class="data-field">
            <label for="album">Album</label>
            <input id="album" type="text" name="album" value="<?= $edit['album'] ?>"/>
        </div>

        <?php if (isset($genreError)) { ?>
            <p class="errors"><?= $genreError; ?></p>
        <?php } ?>
        <div class="data-field">
            <label for="genre">Genre</label>
            <input id="genre" type="text" name="genre" value="<?= $edit['genre'] ?>"/>
        </div>

        <?php if (isset($yearError)) { ?>
            <p class="errors"><?= $yearError; ?></p>
        <?php } ?>
        <div class="data-field">
            <label for="year">Year</label>
            <input id="year" type="text" name="year" value="<?= $edit['year'] ?>"/>
        </div>

        <?php if (isset($tracksError)) { ?>
            <p class="errors"><?= $tracksError; ?></p>
        <?php } ?>
        <div class="data-field">
            <label for="tracks">Tracks</label>
            <input id="tracks" type="number" name="tracks" value="<?= $edit['tracks'] ?>"/>
        </div>

        <div class="data-submit">
            <input type="hidden" name="album-number" value=""/>
            <input type="submit" name="submit" value="Save"/>
        </div>
    </form>
</section>

<div>
    <a href="index.php">Go back to the list</a>
</div>
</body>
</html>
