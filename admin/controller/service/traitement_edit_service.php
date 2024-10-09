<?php
require_once('../../../config.php');
session_start();
require CLASSES_PATH.'/Service.php';
require CLASSES_PATH.'/Database.php';
$page = '5';
$section = '3';
$id = (int) htmlspecialchars($_POST['idService']);
$header = sprintf('Location: %s?page=%s&section=%s&id=%s', ADMIN_PUBLIC_URL, $page, $section, $id);
$service = new Service();

$success_message = 'Le service a été bien modifié';
$fail_message = 'Le service n\'a pas été modifié correctement';

$requiredFields = ['enName', 'enContent', 'frName', 'frContent'];
$isValid = true;

foreach ($requiredFields as $field) {
    if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
        $isValid = false;
        break;
    }
}

if ($isValid) {
    $enName = htmlspecialchars($_POST['enName']);
    $frName = htmlspecialchars($_POST['frName']);
    $enContent = htmlspecialchars($_POST['enContent']);
    $frContent = htmlspecialchars($_POST['frContent']);

    try {
        $service->update2($frName, $frContent, $id, 'fr');
        $service->update2($enName, $enContent, $id, 'en');
        $_SESSION['success-edit-service'] = $success_message;
        header($header);
        exit();
    } catch (Exception $e) {
        $_SESSION['fail-edit-service'] = $fail_message;
        session_write_close();
        header($header);
        error_log($e->getMessage());
        throw new Exception("Unable to edit service: " . $e->getMessage());
    }
} else {
    $_SESSION['fail-edit-service'] = $fail_message;
    session_write_close();
    header($header);
}
