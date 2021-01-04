<?php

$hour = date("H");

if($hour >= 0 && $hour < 6){
    echo "Goedenacht";
}

if($hour >= 6 && $hour < 12){
    echo "Goedemorgen";
}

if($hour >= 12 && $hour < 18){
    echo "Goedemiddag";
}

if($hour >= 18 && $hour < 0){
    echo "Goedeavond";
}

?>