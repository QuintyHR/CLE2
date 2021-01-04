<?php
require_once 'musicData.php';
/** @var array $albums */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title>Music Collection - Week 2</title>
</head>

<body>
<h1>Music Collection</h1>
<br>
<p><a href="create.php">Create new album</a></p>
<table>

    <thead>
    <tr>
        <th>#</th>
        <th>Artist</th>
        <th>Album</th>
        <th>Genre</th>
        <th>Year</th>
        <th>Tracks</th>
        <th>Details</th>
        <th>Edit</th>
    </tr>
    </thead>

    <tfoot>
    <tr>
        <td colspan="8">&copy; My Collection</td>
    </tr>
    </tfoot>

    <tbody>
        <?php foreach ($albums as $key => $album) { ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $album['artist'] ?></td>
                <td><?= $album['album'] ?></td>
                <td><?= $album['genre'] ?></td>
                <td><?= $album['year'] ?></td>
                <td><?= $album['tracks'] ?></td>
                <td><a href="details.php?music=<?= $key ?>">Details</a></td>
                <td><a href="edit.php?music=<?= $key ?>">Edit</a></td>
            </tr>
        <?php } ?>
    </tbody>

</table>
</body>
</html>
