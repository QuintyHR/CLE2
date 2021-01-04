<?php
//Require music data to use the db variable in this file
require_once 'includes/database.php';
/** @var array $albums */

//Get the result set from the database with a SQL query


//Loop through the result to create a custom array


//Close connection

?>

<!doctype html>
<html lang="en">
<head>
    <title>Music Collection</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/alternative.css"/>
</head>
<body>
<main>
    <h1>Music collection full of awesomeness!</h1>

    <nav>
        <a href="index.php">Check default view</a>
    </nav>

    <div class="albums">
        <?php foreach ($albums as $index => $album) { ?>
            <album>
                <div class="cover">
                    <a href="detail.php?index=<?= $index ?>">
                        <img src="images/<?= $album['image'] ?>" alt=""/>
                    </a>
                </div>
                <div class="links">
                    <a class="detail" href="detail.php?index=<?= $index ?>"><p>
                            <?= $album['artist'] ?>
                        </p></a>
                </div>
            </album>
        <?php } ?>
    </div>
</main>
</body>
</html>