<?php
require_once 'includes/database.php';
/** @var array $albums */
/** @var $db */

mysqli_close($db);
?>

<!doctype html>
<html lang="en">
<head>
    <title>Music Collection</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>

<body>
<h1>Music Collection</h1>
<a href="index-alternative.php">Check alternative view</a>

<table>
    <thead>
    <tr>
        <th></th>
        <th>#</th>
        <th>Artist</th>
        <th>Album</th>
        <th>Genre</th>
        <th>Year</th>
        <th>Tracks</th>
        <th colspan="2"></th>
    </tr>
    </thead>

    <tfoot>
    <tr>
        <td colspan="9">&copy; My Collection</td>
    </tr>
    </tfoot>

    <tbody>
        <?php foreach ($albums as $index => $album) { ?>
            <tr>
                <td class="image"><img src="images/<?= $album['image'] ?>" alt=""/></td>
                <td><?= $album['id'] ?></td>
                <td><?= $album['artist'] ?></td>
                <td><?= $album['album'] ?></td>
                <td><?= $album['genre'] ?></td>
                <td><?= $album['year'] ?></td>
                <td><?= $album['tracks'] ?></td>
                <td><a href="detail.php?index=<?= $album['id'] ?>">Details</a></td>
                <td><a href="edit.php?index=<?= $index ?>">Edit</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

</body>
</html>