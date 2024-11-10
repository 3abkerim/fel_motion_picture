<?php
require_once('../../../config.php');
session_start();
require CLASSES_PATH.'/HomepageText.php';
require CLASSES_PATH.'/Database.php';
$page = '7';
$header = sprintf('Location: %s?page=%s', ADMIN_PUBLIC_URL, $page);
$homepageText = new HomepageText();

$success_message = 'Le text a été bien modifié';
$fail_message = 'Le text n\'a pas été modifié correctement';

$requiredFields = ['enContent','frContent'];
$isValid = true;

foreach ($requiredFields as $field) {
    if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
        $isValid = false;
        break;
    }
}

if ($isValid) {
    $enContent = htmlspecialchars($_POST['enContent']);
    $frContent = htmlspecialchars($_POST['frContent']);

    try {
        $homepageText->update($frContent, 'fr');
        $homepageText->update($enContent, 'en');
        $_SESSION['success-edit'] = $success_message;
        header($header);
        exit();
    } catch (Exception $e) {
        $_SESSION['fail-edit'] = $fail_message;
        session_write_close();
        header($header);
        error_log($e->getMessage());
        throw new Exception("Unable to edit homepage text: " . $e->getMessage());
    }
} else {
    $_SESSION['fail-edit-service'] = $fail_message;
    session_write_close();
    header($header);
}
