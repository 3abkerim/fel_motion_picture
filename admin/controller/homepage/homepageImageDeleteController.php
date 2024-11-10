<?php
require_once('../../../config.php');
session_start();
require CLASSES_PATH.'/HomeImages.php';
require CLASSES_PATH.'/Database.php';

$page = '7';
$section = '2';
$header = sprintf('Location: %s?page=%s&section=%s', ADMIN_PUBLIC_URL, $page, $section);
$homeImages = new HomeImages();

$idPhoto = isset($_GET['idPhoto']) ? $_GET['idPhoto'] : null;

if ($idPhoto !== null && is_numeric($idPhoto)) {
    if ($homeImages->delete($idPhoto)) {
        $_SESSION['success'] = 'La photo a été bien supprimée';
    } else {
        $_SESSION['fail'] = 'Erreur lors de la suppression de la photo';
    }
} else {
    $_SESSION['fail'] = 'ID de la photo non valide';
}

header($header);
exit();