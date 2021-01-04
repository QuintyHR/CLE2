<?php
require_once 'includes/database.php';
/** @var array $albums */
/** @var $db */

$query = "SELECT * FROM albums";
$result = mysqli_query($db, $query);

$albums = [];
while($row = mysqli_fetch_assoc($result)) {
    $albums[] = $row;
}

mysqli_close($db);
?>

<!doctype html>
<html lang="en">
<head>
    <title>Music Collection</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body id="alternative">
<div id="container">
    <h1>Music collection full of awesomeness!</h1>

    <div class="intro-links">
        <a href="create.php">Create new album</a>
        <a href="index.php">Check default view</a>
    </div>

    <div class="albums">
        <?php foreach ($albums as $album) { ?>
            <div class="album">
                <div class="cover">
                    <a href="details.php?id=<?= $album['id'] ?>">
                        <img src="images/<?= $album['image'] ?>" alt="<?= $album['album'] ?>"/>
                    </a>
                </div>
                <div class="links">
                    <a class="detail" href="details.php?id=<?= $album['id'] ?>"><?= $album['artist'] . " - " . $album['album'] ?></a>
                    <a class="edit" href="edit.php?id=<?= $album['id'] ?>">Edit</a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
</body>
</html>
