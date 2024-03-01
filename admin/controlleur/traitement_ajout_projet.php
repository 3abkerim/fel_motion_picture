<?php

session_start();
require '../../src/classes/Project.php';
require '../../src/classes/Database.php';

$project = new Project();

if (isset($_POST['enName'], $_POST['enContent'], $_POST['frName'], $_POST['frContent'], $_POST['date'], $_POST['categ']) && !empty($_POST['enName']) && !empty($_POST['enContent']) && !empty($_POST['frName']) && !empty($_POST['frContent']) && !empty($_POST['date']) && !empty($_POST['categ'])) {
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

$requiredFields = ['enName', 'enContent', 'frName', 'frContent', 'date', 'categ'];
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
    $date = htmlspecialchars($_POST['date']);
    $categ = htmlspecialchars($_POST['categ']);

    try{
        $project->save()

    }catch (Exception $e){

    }
} else {
}
