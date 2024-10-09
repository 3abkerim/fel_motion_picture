<?php
require_once('../../../config.php');
session_start();
require CLASSES_PATH.'/Categorie.php';
require CLASSES_PATH.'/Database.php';
$page = '4';
$header = sprintf('Location: %s?page=%s', ADMIN_PUBLIC_URL, $page);
$success_message = 'La catégorie a été bien ajoutée';
$fail_message = 'La catégorie n\'a pas été ajoutée correctement';

$categorie = new Categorie();

if (isset($_POST['frCateg'], $_POST['enCateg']) && !empty($_POST['frCateg']) && !empty($_POST['enCateg'])) {
    $frCateg = htmlspecialchars($_POST['frCateg']);
    $enCateg = htmlspecialchars($_POST['enCateg']);

    try {
        $id = $categorie->save1();
        $categorie->save2($id, 'fr', $frCateg);
        $categorie->save2($id, 'en', $enCateg);
        $_SESSION['success-add-categ'] = $success_message;
    } catch (Exception $e) {
        $_SESSION['fail-add-categ'] = $fail_message;
        throw new Exception("Unable to add categories: " . $e->getMessage());
    }
    header($header);
    exit();
} else {
    $_SESSION['fail-add-categ'] = $fail_message;
    header($header);
}
