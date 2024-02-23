<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require '../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../vendor/phpmailer/phpmailer/src/SMTP.php';



$PHPMailer = new PHPMailer(true);


require '../../config/config.php';
date_default_timezone_set('Europe/Paris');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $mail = htmlspecialchars($_POST["mail"]);
    $subject = htmlspecialchars($_POST["subject"]);
    $main = htmlspecialchars($_POST["main"]);
    $dateTime = date('Y-m-d H:i:s');

    $Message = new Message();
    $Message->setName($name);
    $Message->setEmail($email);
    $Message->setSubject($subject);
    $Message->setMessage($main);
    $Message->setDateTime($dateTime);

    $Message->save();


    // if ($Message->save()) {
    //     try {
    //         //Server settings
    //         $PHPMailer->isSMTP();
    //         $PHPMailer->Host       = 'smtp.example.com'; // Set the SMTP server to send through
    //         $PHPMailer->SMTPAuth   = true;
    //         $PHPMailer->Username   = 'your_email@example.com'; // SMTP username
    //         $PHPMailer->Password   = 'your_password'; // SMTP password
    //         $PHPMailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    //         $PHPMailer->Port       = 587;

    //         //Recipients
    //         $PHPMailer->setFrom('from@example.com', 'Mailer');
    //         $PHPMailer->addAddress('to@example.com', 'Joe User'); // Add a recipient

    //         // Content
    //         $PHPMailer->isHTML(true);
    //         $PHPMailer->Subject = 'Thank you for contacting us !';
    //         $PHPMailer->Body    = 'This is the HTML message body <b>in bold!</b>';
    //         $PHPMailer->AltBody = 'This is the body in plain text for non-HTML mail clients';

    //         $PHPMailer->send();
    //         echo 'Message has been sent';
    //     } catch (Exception $e) {
    //         echo "Message could not be sent. Mailer Error: {$PHPMailer->ErrorInfo}";
    //     }
    // }

    header("Location:../../public/index.php?page=6");
}
