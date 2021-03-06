<?php
$emailAddress = $_SESSION['email'];
$name = $_SESSION['firstname'] . ' ' . $_SESSION['surname'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'plugins/PHPMailer/src/Exception.php';
require 'plugins/PHPMailer/src/PHPMailer.php';
require 'plugins/PHPMailer/src/SMTP.php';


// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'mail.kevin-jansen.dev';
    $mail->SMTPAuth = true;
    $mail->Username = 'noreply@kevin-jansen.dev';
    $mail->Password = '4#hy9yP9';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->setFrom('noreply@kevin-jansen.dev');
    $mail->addAddress($emailAddress, $name);
    $mail->addReplyTo('artsylilianaviolet@gmail.com');
    //$mail->addCC('artsylilianaviolet@gmail.com');
    //$mail->addBCC('artsylilianaviolet@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = 'Bedankt voor uw bestelling!';
    $mail->Body = 'Bedankt voor uw bestelling bij van Huissteden. <br> Uw bestelling zal zo spoedig mogelijk verwerkt worden.';
    $mail->AltBody = 'Bedankt voor uw bestelling bij van Huissteden. Uw bestelling zal zo spoedig mogelijk verwerkt worden.';

    $mail->send();
} catch (Exception $exception) {
    echo 'Error: ' . $mail->ErrorInfo;
}