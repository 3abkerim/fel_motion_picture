<?php
session_start();
require '../../src/classes/Categorie.php';
require '../../src/classes/Database.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$categorie = new Categorie;

try {
    $test = $categorie->delete($id);
    $_SESSION['success-delete-categ'] = 'La catégorie a été supprimée correctement';
} catch (Exception $e) {
    $_SESSION['fail-delete-categ'] = 'La catégorie n\'a pas été supprimée correctement';
    throw new Exception("Unable to add categories: " . $e->getMessage());
}

header('Location: ../public/index.php?page=4&section=2');
exit();
