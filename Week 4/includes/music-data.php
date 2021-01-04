<?php
//Require DB settings with connection variable
/** @var $db */
require_once "database.php";

$query = "SELECT * FROM albums";
$result = mysqli_query($db, $query);

$musicAlbums = [];
while ($row = mysqli_fetch_assoc($result)) {
    $musicAlbums[] = $row;
}

mysqli_close($db);
