<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'plugins/PHPMailer/src/Exception.php';
require 'plugins/PHPMailer/src/PHPMailer.php';
require 'plugins/PHPMailer/src/SMTP.php';

$email = $_POST['email'];
$name = $_POST['firstname'] . ' ' . $_POST['surname'];

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = 2;

    $mail->isSMTP();
    $mail->Host = 'mail.kevin-jansen.dev';
    $mail->SMTPAuth = true;
    $mail->Username = 'noreply@kevin-jansen.dev';
    $mail->Password = '4#hy9yP9';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->setFrom('noreply@kevin-jansen.dev');
    $mail->addAddress($email, 'Quinty de Jong');
    $mail->addReplyTo('artsylilianaviolet@gmail.com');
    //$mail->addCC('artsylilianaviolet@gmail.com');
    //$mail->addBCC('artsylilianaviolet@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = 'Bedankt voor uw bestelling!';
    $mail->Body = 'Dit is een bericht met <strong>HTML</strong>';
    $mail->AltBody = 'Dit is een bericht zonder HTML';

    $mail->send();
    echo 'Bericht is verzonden!';
} catch (Exception $exception) {
    echo 'Error: ' . $mail->ErrorInfo;
}