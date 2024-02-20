<?php
require '../../config/config.php';
date_default_timezone_set('Europe/Paris');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $mail = htmlspecialchars($_POST["mail"]);
    $subject = htmlspecialchars($_POST["subject"]);
    $main = htmlspecialchars($_POST["main"]);
    $dateTime = date('Y-m-d H:i:s');





    $Message = new Message($name, $mail, $subject, $main, $dateTime);
    $Message->save();
    if ($Message->save()) {
    }
}
