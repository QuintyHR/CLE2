<?php
// General settings
$host       = "localhost";
$database   = "music_collection";
$user       = "root";
$password   = "";

$db = mysqli_connect($host, $user, $password, $database)
        or die("Error: " . mysqli_connect_error());;

$query = "SELECT * FROM albums";
$result = mysqli_query($db, $query);

$albums = [];
while($row = mysqli_fetch_assoc($result)) {
    $albums[] = $row;
}
