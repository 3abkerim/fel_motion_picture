<?php
require_once('../../../config.php');
session_start();
require CLASSES_PATH.'/Service.php';
require CLASSES_PATH.'/Database.php';
$page = '5';
$header = sprintf('Location: %s?page=%s', ADMIN_PUBLIC_URL, $page);
$success_message = 'Le service a été bien ajouté';
$fail_message = 'Le service n\'a pas été ajouté correctement';

$service = new Service();

if (!isset($_POST['frName'], $_POST['enName'], $_POST['frContent'], $_POST['enContent']) ||
    empty($_POST['frName']) ||
    empty($_POST['enName']) ||
    empty($_POST['frContent']) ||
    empty($_POST['enContent'])
) {
    $_SESSION['fail-add-service'] = $fail_message;
    header($header);
    exit();
}

$frName = htmlspecialchars($_POST['frName']);
$enName = htmlspecialchars($_POST['enName']);
$frContent = htmlspecialchars($_POST['frContent']);
$enContent = htmlspecialchars($_POST['enContent']);

try {
    $id = $service->save1();
    $service->save2($id, 'fr', $frName, $frContent);
    $service->save2($id, 'en', $enName, $enContent);
    $_SESSION['success-add-service'] = $success_message;
} catch (Exception $e) {
    $_SESSION['fail-add-service'] = $fail_message;
    throw new Exception("Unable to add service: " . $e->getMessage());
}
header($header);
exit();