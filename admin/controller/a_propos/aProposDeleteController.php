<?php
require_once('../../../config.php');
session_start();
require CLASSES_PATH.'/About.php';
require CLASSES_PATH.'/Database.php';
$page = '6';
$section = '2';
$header = sprintf('Location: %s?page=%s&section=%s', ADMIN_PUBLIC_URL, $page, $section);
$success_message = 'Le text a été supprimé correctement';
$fail_message = 'Le text n\'a pas été supprimé correctement';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$about = new About();

try {
    $test = $about->delete($id);
    $_SESSION['success-delete'] = $success_message;
} catch (Exception $e) {
    $_SESSION['fail-delete'] = $fail_message;
    throw new Exception("Unable to delete about us element: " . $e->getMessage());
}

header($header);
exit();
