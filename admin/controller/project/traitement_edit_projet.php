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

$id = htmlspecialchars($_POST['id']);
$page = '2';
$section = '3';
$header = sprintf('Location: %s?page=%s&section=%s&id=%s', ADMIN_PUBLIC_URL, $page, $section, $id);

if ($isValid) {
    $enName = htmlspecialchars($_POST['enName']);
    $frName = htmlspecialchars($_POST['frName']);
    $enContent = htmlspecialchars($_POST['enContent']);
    $frContent = htmlspecialchars($_POST['frContent']);
    $idCateg = htmlspecialchars($_POST['categ']);
    $dateInput = htmlspecialchars($_POST['date']);
    $dateObject = DateTime::createFromFormat('d/m/Y', $dateInput);
    $date = $dateObject ? $dateObject->format('Y-m-d') : null;

    try {
        $test = $project->update1($date, $idCateg, $id);
        $test2 = $project->update2($enName, $enContent, $id, 'en');
        $test3 = $project->update2($frName, $frContent, $id, 'fr');

        $_SESSION['success-edit-project'] = 'Le project a été modifié correctement';
        header($header);
        exit();
    } catch (Exception $e) {
        $_SESSION['fail-edit-project'] = 'Le project n\'a pas été modifié correctement';
        session_write_close();
        header($header);
        error_log($e->getMessage());

        throw new Exception("Unable to edit project: " . $e->getMessage());
    }
} else {
    $_SESSION['fail-edit-project'] = 'Veuillez remplir tous les données';

    session_write_close();
    header($header);
}
