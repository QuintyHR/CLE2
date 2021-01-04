<?php
    $albums = array(
        1 => array(
            "albumName" => "Arcade Fire",
            "artist" => "The Suburbs",
            "releaseDate" => "2010",
            "tracks" => "16",
        ),
        2 => array(
            "albumName" => "A Moon Shaped Pool",
            "artist" => "Radiohead",
            "releaseDate" => "2016",
            "tracks" => "11",
        ),
        3 => array(
            "albumName" => "Nonagon Infinty",
            "artist" => "King Gizzard & the Lizard Wizard",
            "releaseDate" => "2016",
            "tracks" => "9",
        ),
        4 => array(
            "albumName" => "An awesome Wave",
            "artist" => "alt-J",
            "releaseDate" => "2012",
            "tracks" => "14",
        ),
        5 => array(
            "albumName" => "Bon Iver, Bon Iver",
            "artist" => "Bon Iver",
            "releaseDate" => "2011",
            "tracks" => "10",
        ),
        6 => array(
            "albumName" => "Lonerism",
            "artist" => "Tame Impala",
            "releaseDate" => "2012",
            "tracks" => "12",
        ),
        7 => array(
            "albumName" => "Joy as an Act of Resistance",
            "artist" => "IDLES",
            "releaseDate" => "2018",
            "tracks" => "12",
        ),
        8 => array(
            "albumName" => "To Pimp a Butterfly",
            "artist" => "Kandrick Lamar",
            "releaseDate" => "2015",
            "tracks" => "16",
        ),
        9 => array(
            "albumName" => "Blackstar",
            "artist" => "David Bowie",
            "releaseDate" => "2016",
            "tracks" => "7",
        ),
        10 => array(
            "albumName" => "High Violet",
            "artist" => "The National",
            "releaseDate" => "2010",
            "tracks" => "11",
        )
    );
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Music Collection</title>
    <link rel="stylesheet" type="text/css" href="music.css"/>
</head>

<body>
<h1>Music Collection</h1>
<hr/>

<p>
    Dit is een lijst met de top 10 albums van 2010-2019 volgens <a href="https://www.dansendeberen.be/2019/11/06/de-100-beste-albums-van-het-decennium-2010-2019/10/">deze</a> website.
</p>

<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Artist</th>
        <th>Album</th>
        <th>Year</th>
        <th>Tracks</th>
    </tr>
    </thead>

    <tfoot>
    <tr>
        <td colspan="5">&copy; My Collection</td>
    </tr>
    </tfoot>

    <tbody>
        <?php foreach ($albums as $key => $album) { ?>
            <tr>
                <td><?= $key ?></td>
                <td><?= $album['artist'] ?></td>
                <td><?= $album['albumName'] ?></td>
                <td><?= $album['releaseDate'] ?></td>
                <td><?= $album['tracks'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</body>
</html>
