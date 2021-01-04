<?php
//Require music data to use variable in this file
require_once "includes/database.php";
/** @var $db */

//TODO: Handle POST data & store in DB
if (isset($_POST['submit'])) {
    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $artist = $_POST['artist'];
    $album = $_POST['album'];
    $genre = $_POST['genre'];
    $year = $_POST['year'];
    $tracks = $_POST['tracks'];
    $albumId = $_POST['id'];

    //Secure the data above

    //Check if data is valid & generate error if not so
    $errors = [];
//    if ($image == "") {
//        $errors[] = 'Image cannot be empty';
//    }
    if ($artist == "") {
        $errors[] = 'Artist cannot be empty';
    }
    if ($album == "") {
        $errors[] = 'Album cannot be empty';
    }
    if ($genre == "") {
        $errors[] = 'Genre cannot be empty';
    }
    if ($year == "") {
        $errors[] = 'Year cannot be empty';
    }
    if (!is_numeric($year) || strlen($year) != 4) {
        $errors[] = 'Year needs to be a number with the length of 4';
    }
    if ($tracks == "") {
        $errors[] = 'Tracks cannot be empty';
    }
    if (!is_numeric($tracks)) {
        $errors[] = 'Tracks need to be a number';
    }

    if(empty($errors)) {
        // Now this data can be stored in de database
        $query = "UPDATE albums SET artist = '$artist', 
                                    album = '$album',
                                    genre = '$genre',
                                    year = '$year',
                                    tracks = '$tracks'
                    WHERE id = '" . mysqli_escape_string($db, $albumId) . "'";
        $result = mysqli_query($db, $query);

        if ($result) {
            header('Location: index.php');
            exit();
        }
        else {
            $errors['db'] = mysqli_error($db);
        }
    }

} elseif (isset($_GET['id'])) {
    //Retrieve the GET parameter from the 'Super global'
    $albumId = $_GET['id'];

    $query = "SELECT * FROM albums WHERE id = $albumId";
    $result = mysqli_query($db, $query)
        or die('Error'. mysqli_error($db));
    if ($result) {
        $album = mysqli_fetch_assoc($result);
    }
}

mysqli_close($db);
?>

<!doctype html>
<html lang="en">
<head>
    <title>Music Collection Edit</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<h1>Edit "<?= $album['artist'] . ' - ' . $album['album']; ?>"</h1>

<form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">
    <div class="data-field">
        <label for="artist">Artist</label>
        <input id="artist" type="text" name="artist" value="<?= $album['artist']; ?>"/>
    </div>
    <div class="data-field">
        <label for="album">Album</label>
        <input id="album" type="text" name="album" value="<?= $album['album']; ?>"/>
    </div>
    <div class="data-field">
        <label for="genre">Genre</label>
        <input id="genre" type="text" name="genre" value="<?= $album['genre']; ?>"/>
    </div>
    <div class="data-field">
        <label for="year">Year</label>
        <input id="year" type="text" name="year" value="<?= $album['year']; ?>"/>
    </div>
    <div class="data-field">
        <label for="tracks">Tracks</label>
        <input id="tracks" type="number" name="tracks" value="<?= $album['tracks']; ?>"/>
    </div>
    <div class="data-submit">
        <input type="hidden" name="id" value="<?= $albumId; ?>"/>
        <input type="submit" name="submit" value="Save"/>
    </div>
</form>
<div>
    <a href="index.php">Go back to the list</a>
</div>
</body>
</html>
