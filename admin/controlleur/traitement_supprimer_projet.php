<?php
session_start();
require '../../src/classes/Project.php';
require '../../src/classes/Database.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$project = new Project();

try {
    $test = $project->delete($id);
    $_SESSION['success-delete-project'] = 'Le projet a été supprimée correctement';
} catch (Exception $e) {
    $_SESSION['fail-delete-project'] = 'Le projet n\'a pas été supprimée correctement';
    throw new Exception("Unable to add project: " . $e->getMessage());
}

header('Location: ../public/index.php?page=2&section=2');
exit();
