<?php

session_start();
require '../../../src/classes/Project.php';
require '../../../src/classes/Database.php';

$project = new Project();

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
    $idCateg = htmlspecialchars($_POST['categ']);

    try {
        $id = $project->save1($date, $idCateg);
        $project->save2($id, $enName, $enContent, 'en');
        $project->save2($id, $frName, $frContent, 'fr');
        $_SESSION['success-add-project'] = 'Le project a été ajouté correctement';
        header('Location: ../../public/index.php?page=2');
        exit();
    } catch (Exception $e) {
        $_SESSION['fail-add-project'] = 'Le project n\'a pas été ajouté correctement';
        $_SESSION['form_data'] = $_POST;
        session_write_close();
        header('Location: ../../public/index.php?page=2');
        throw new Exception("Unable to add project: " . $e->getMessage());
    }
} else {
    $_SESSION['fail-add-project'] = 'Veuillez remplir tous les données';
    $_SESSION['form_data'] = $_POST;
    session_write_close();
    header('Location: ../../public/index.php?page=2');
}
