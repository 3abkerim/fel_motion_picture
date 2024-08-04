<?php
session_start();
require '../../../src/classes/Project.php';
require '../../../src/classes/Database.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$project = new Project();
$project->deleteImage($id);

$_SESSION['success_delete_img'] = 'La photo a été bien supprimé';
header('Location: ../../public/index.php?page=2&section=4&id=' . $id);
exit();
