<?php

session_start();
require '../../src/classes/Categorie.php';
require '../../src/classes/Database.php';

$categorie = new Categorie();

if (isset($_POST['frCateg'], $_POST['enCateg']) && !empty($_POST['frCateg']) && !empty($_POST['enCateg'])) {
    $frCateg = htmlspecialchars($_POST['frCateg']);
    $enCateg = htmlspecialchars($_POST['enCateg']);

    try {
        $id = $categorie->save1();
        $categorie->save2($id, 'fr', $frCateg);
        $categorie->save2($id, 'en', $enCateg);
        $_SESSION['success-add-categ'] = 'La catégorie a été bien ajoutée';
    } catch (Exception $e) {
        $_SESSION['fail-add-categ'] = 'La catégorie n\'a pas été ajoutée correctement';
        throw new Exception("Unable to add categories: " . $e->getMessage());
    }
    header('Location: ../public/index.php?page=4');
    exit();
} else {
    $_SESSION['fail-add-categ'] = 'La catégorie n\'a pas été ajoutée correctement';
    header('Location: ../public/index.php?page=4');
}
