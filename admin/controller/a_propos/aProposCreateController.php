<?php
require_once('../../../config.php');
session_start();
require CLASSES_PATH.'/About.php';
require CLASSES_PATH.'/Database.php';
$page = '6';
$header = sprintf('Location: %s?page=%s', ADMIN_PUBLIC_URL, $page);
$success_message = 'Le text a été bien ajouté';
$fail_message = 'Le text n\'a pas été ajouté correctement';

$about = new About();

if (!isset($_POST['frName'], $_POST['enName'], $_POST['frContent'], $_POST['enContent']) ||
    empty($_POST['frName']) ||
    empty($_POST['enName']) ||
    empty($_POST['frContent']) ||
    empty($_POST['enContent'])
) {
    $_SESSION['fail-add-text'] = $fail_message;
    header($header);
    exit();
}

$frName = htmlspecialchars($_POST['frName']);
$enName = htmlspecialchars($_POST['enName']);
$frContent = htmlspecialchars($_POST['frContent']);
$enContent = htmlspecialchars($_POST['enContent']);

try {
    $id = $about->save1();
    $about->save2($id, 'fr', $frName, $frContent);
    $about->save2($id, 'en', $enName, $enContent);
    $_SESSION['success-add-text'] = $success_message;
} catch (Exception $e) {
    $_SESSION['fail-add-text'] = $fail_message;
    throw new Exception("Unable to add text: " . $e->getMessage());
}
header($header);
exit();