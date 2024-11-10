<?php
require_once('../../../config.php');
session_start();
require CLASSES_PATH.'/HomeImages.php';
require CLASSES_PATH.'/Database.php';

$homepageImages = new HomeImages();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $homepageImages->updateImageOrder($data);
}
?>