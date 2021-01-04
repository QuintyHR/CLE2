<?php

$today = date("j-m-y H:i");
$weekAgo = date( "j-m-y H:i", strtotime( "-1 week" ) );
$difference = date( "j-m-y", strtotime( "12-08-2020" ) );
$tillBirthday = date( "j-m-y", strtotime( "02-07-2020" ) );

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
<p>
    Het is vandaag <?= $today ?>
    <br>
    Het is vandaag een week geleden <?= $weekAgo ?>
    <br>
    Het verschil in dagen tussen 5 februari en 12 augustus is <?= $difference ?>
    <br>
    Het aantal nachten slapen tot mijn verjaardag is <?= $tillBirthday ?>
</p>
</body>
</html>
