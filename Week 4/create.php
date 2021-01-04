<?php
require_once 'includes/database.php';
/** @var $db */

//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $image = mysqli_escape_string($db, $_POST['image']);
    $artist = mysqli_escape_string($db, $_POST['artist']);
    $album = mysqli_escape_string($db, $_POST['album']);
    $genre = mysqli_escape_string($db, $_POST['genre']);
    $year = mysqli_escape_string($db, $_POST['year']);
    $tracks = mysqli_escape_string($db, $_POST['tracks']);

    //Secure the data above

    //Check if data is valid & generate error if not so
    $errors = [];
    if ($image == "") {
        $errors[] = 'Image cannot be empty';
    }
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
        $query = "INSERT INTO albums (artist, album, genre, year, tracks)
                    VALUES('$artist', '$album', '$genre', '$year', '$tracks')";
        $result = mysqli_query($db, $query);

        if ($result) {
            $success = "Hij is toegevoegd aan de DB";
        }
        else {
            $errors['db'] = mysqli_error($db);
        }
    }

}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Music Collection Create</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<h1>Create album</h1>
<?php if (isset($errors)) { ?>
    <ul class="errors">
        <?php foreach ($errors as $error) { ?>
            <li><?= $error; ?></li>
        <?php } ?>
    </ul>
<?php } ?>

<form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">
    <div class="data-field">
        <label for="image">Cover</label>
        <input id="image" type="file" name="image" value="<?= (isset($image) ? $image : ''); ?>"/>
        <span class="errors"><?= (isset($errors['image']) ? $errors['image'] : '') ?></span>
    </div>
    <div class="data-field">
        <label for="artist">Artist</label>
        <input id="artist" type="text" name="artist" value="<?= (isset($artist) ? htmlentities($artist) : ''); ?>"/>
        <span class="errors"><?= (isset($errors['artist']) ? $errors['artist'] : '') ?></span>
    </div>
    <div class="data-field">
        <label for="album">Album</label>
        <input id="album" type="text" name="album" value="<?= (isset($album) ? htmlentities($album) : ''); ?>"/>
        <span class="errors"><?= (isset($errors['album']) ? $errors['album'] : '') ?></span>
    </div>
    <div class="data-field">
        <label for="genre">Genre</label>
        <input id="genre" type="text" name="genre" value="<?= (isset($genre) ? htmlentities($genre) : ''); ?>"/>
        <span class="errors"><?= (isset($errors['genre']) ? $errors['genre'] : '') ?></span>
    </div>
    <div class="data-field">
        <label for="year">Year</label>
        <input id="year" type="text" name="year" value="<?= (isset($year) ? htmlentities($year) : ''); ?>"/>
        <span class="errors"><?= (isset($errors['year']) ? $errors['year'] : '') ?></span>
    </div>
    <div class="data-field">
        <label for="tracks">Tracks</label>
        <input id="tracks" type="number" name="tracks" value="<?= (isset($tracks) ? htmlentities($tracks) : ''); ?>"/>
        <span class="errors"><?= (isset($errors['tracks']) ? $errors['tracks'] : '') ?></span>
    </div>
    <div class="data-submit">
        <input type="submit" name="submit" value="Save"/>
    </div>
</form>
<div>
    <a href="index.php">Go back to the list</a>
</div>
</body>
</html>
