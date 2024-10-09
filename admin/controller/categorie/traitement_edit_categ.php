<?php
require_once('../../../config.php');
session_start();
require CLASSES_PATH.'/Categorie.php';
require CLASSES_PATH.'/Database.php';
$page = '4';
$section = '3';
$id = htmlspecialchars($_POST['idCateg']);

$header = sprintf('Location: %s?page=%s&section=%s&id=%s', ADMIN_PUBLIC_URL, $page, $section, $id);
$success_message = 'La catégorie a été bien modifiée';
$fail_message = 'La catégorie n\'a pas été modifiée correctement';

$categorie = new Categorie();

if (isset($_POST['frCateg'], $_POST['enCateg']) && !empty($_POST['frCateg']) && !empty($_POST['enCateg'])) {
    $frCateg = htmlspecialchars($_POST['frCateg']);
    $enCateg = htmlspecialchars($_POST['enCateg']);

    try {
        $categorie->edit($frCateg, $id, 'fr');
        $categorie->edit($enCateg, $id, 'en');
        $_SESSION['success-edit-categ'] = $success_message;
    } catch (Exception $e) {
        $_SESSION['fail-edit-categ'] = $fail_message;
        throw new Exception("Unable to add categories: " . $e->getMessage());
    }
    header($header);
    exit();
} else {
    $_SESSION['fail-edit-categ'] = $fail_message;
    header($header);
}
