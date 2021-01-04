<?php

$today1 = date("j F Y");
$today2 = date("j/n/Y");
$timeHour = date("H");
$timeMinute = date("i");

echo "Het is vandaag " . "$today1" . "<br/>";
echo "Het is vandaag " . "$today2" . "<br/>";
echo "Het is nu " . "$timeHour" . " uur en " . "$timeMinute" . " minuten" . "<br/>";

?>