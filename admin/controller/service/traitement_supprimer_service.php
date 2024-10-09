<?php
require_once('../../../config.php');
session_start();
require CLASSES_PATH.'/Service.php';
require CLASSES_PATH.'/Database.php';
$page = '5';
$section = '2';
$header = sprintf('Location: %s?page=%s&section=%s', ADMIN_PUBLIC_URL, $page, $section);
$success_message = 'Le service a été supprimé correctement';
$fail_message = 'Le service n\'a pas été supprimé correctement';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$service = new Service();

try {
    $test = $service->delete($id);
    $_SESSION['success-delete-service'] = $success_message;
} catch (Exception $e) {
    $_SESSION['fail-delete-categorie'] = $fail_message;
    throw new Exception("Unable to add categorie: " . $e->getMessage());
}

header($header);
exit();
