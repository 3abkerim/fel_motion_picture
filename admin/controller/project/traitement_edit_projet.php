<?php
require_once('../../../config.php');
session_start();
require CLASSES_PATH.'/Project.php';
require CLASSES_PATH.'/Database.php';

$project = new Project();

$requiredFields = ['enName', 'enContent', 'frName', 'frContent', 'date', 'categ', 'id'];
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
    $idCateg = htmlspecialchars($_POST['categ']);
    $id = htmlspecialchars($_POST['id']);


    $dateInput = htmlspecialchars($_POST['date']);
    $dateObject = DateTime::createFromFormat('d/m/Y', $dateInput);
    $date = $dateObject ? $dateObject->format('Y-m-d') : null;


    try {
        $test = $project->update1($date, $idCateg, $id);
        // var_dump($test);
        $test2 = $project->update2($enName, $enContent, $id, 'en');
        // var_dump($test2);
        $test3 = $project->update2($frName, $frContent, $id, 'fr');
        // var_dump($test3);

        $_SESSION['success-edit-project'] = 'Le project a été modifié correctement';
        header('Location: ../../public/index.php?page=2&section=3&id=' . $id);
        exit();
    } catch (Exception $e) {
        $_SESSION['fail-edit-project'] = 'Le project n\'a pas été modifié correctement';
        session_write_close();
        header('Location: ../../public/index.php?page=2&section=3&id=' . $id);
        error_log($e->getMessage());

        throw new Exception("Unable to edit project: " . $e->getMessage());
    }
} else {
    $_SESSION['fail-edit-project'] = 'Veuillez remplir tous les données';
    error_log($e->getMessage());

    session_write_close();
    header('Location: ../../public/index.php?page=2&section=3&id=' . $id);
}
