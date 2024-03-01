<?php
session_start();
require '../../src/classes/Categorie.php';
require '../../src/classes/Database.php';

$categorie = new Categorie();
$id = htmlspecialchars($_POST['idCateg']);

if (isset($_POST['frCateg'], $_POST['enCateg']) && !empty($_POST['frCateg']) && !empty($_POST['enCateg'])) {
    $frCateg = htmlspecialchars($_POST['frCateg']);
    $enCateg = htmlspecialchars($_POST['enCateg']);

    try {
        $categorie->edit($frCateg, $id, 'fr');
        $categorie->edit($enCateg, $id, 'en');
        $_SESSION['success-edit-categ'] = 'La catégorie a été bien modifiée';
    } catch (Exception $e) {
        $_SESSION['fail-edit-categ'] = 'La catégorie n\'a pas été modifiée correctement';
        throw new Exception("Unable to add categories: " . $e->getMessage());
    }
    header('Location: ../public/index.php?page=4&section=3&id=' . $id);
    exit();
} else {
    $_SESSION['fail-edit-categ'] = 'La catégorie n\'a pas été modifiée correctement';
    header('Location: ../public/index.php?page=4&section=3&id=' . $id);
}
