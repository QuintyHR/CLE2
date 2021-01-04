<?php
// Check if form is submitted.
if(isset($_POST['submit'])) {
    // 'Post back' with the data from the form.
    $artist = $_POST['artist'];
    $album = $_POST['album'];
    $genre = $_POST['genre'];
    $year = $_POST['year'];
    $tracks = $_POST['tracks'];

    $errors = [];
    if($artist == "") {
        $errors[] = "Artist mag niet leeg zijn, probeer het opnieuw!";
    }
    if($album == "") {
        $errors[] = "Album mag niet leeg zijn, probeer het opnieuw!";
    }
    if($genre == "") {
        $errors[] = "Genre mag niet leeg zijn, probeer het opnieuw!";
    }
    if($year == "") {
        $errors[] = "Year mag niet leeg zijn, probeer het opnieuw!";
    }
    if($tracks == "") {
        $errors[] = "Tracks mag niet leeg zijn, probeer het opnieuw!";
    }

    if(empty($errors)) {
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
    <title>Music Collection - Create new album</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>
<section>
    <h1>Create new album</h1>

    <?php if(isset($errors)) { ?>

        <ul class="errors">
            <?php foreach ($errors as $error) { ?>
                <li><?= $error ?></li>
            <?php } ?>
        </ul>

    <?php } ?>

    <form action="" method="post">
        <div class="data-field">
            <label for="artist">Artist</label>
            <input id="artist" type="text" name="artist"
                   value="<?= isset($artist) ? $artist : '' ?>"/>
        </div>

        <div class="data-field">
            <label for="album">Album</label>
            <input id="album" type="text" name="album"
                   value="<?= isset($album) ? $album : '' ?>"/>
        </div>

        <div class="data-field">
            <label for="genre">Genre</label>
            <input id="genre" type="text" name="genre"
                   value="<?= isset($genre) ? $genre : '' ?>"/>
        </div>

        <div class="data-field">
            <label for="year">Year</label>
            <input id="year" type="text" name="year"
                   value="<?= isset($year) ? $year : '' ?>"/>
        </div>

        <div class="data-field">
            <label for="tracks">Tracks</label>
            <input id="tracks" type="number" name="tracks"
                   value="<?= isset($tracks) ? $tracks : '' ?>"/>
        </div>

        <div class="data-submit">
            <input type="submit" name="submit" value="Save"/>
        </div>
    </form>
</section>

<div>
    <a href="index.php">Go back to the list</a>
</div>
</body>
</html>
