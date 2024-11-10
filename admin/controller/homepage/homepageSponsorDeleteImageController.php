<?php
require_once('../../../config.php');
session_start();
require CLASSES_PATH.'/Sponsor.php';
require CLASSES_PATH.'/Database.php';

$page = '7';
$section = '3';
$header = sprintf('Location: %s?page=%s&section=%s', ADMIN_PUBLIC_URL, $page, $section);
$sponsor = new Sponsor();

$idPhoto = isset($_GET['idPhoto']) ? $_GET['idPhoto'] : null;
var_dump($idPhoto);

if ($idPhoto !== null && is_numeric($idPhoto)) {
    if ($sponsor->delete($idPhoto)) {
        $_SESSION['success'] = 'La photo a été bien supprimée';
    } else {
        $_SESSION['fail'] = 'Erreur lors de la suppression de la photo';
    }
} else {
    $_SESSION['fail'] = 'ID de la photo non valide';
}

//header($header);
//exit();