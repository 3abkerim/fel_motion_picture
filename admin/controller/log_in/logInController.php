<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../../../config.php');
session_start();
require CLASSES_PATH . '/User.php';
require CLASSES_PATH . '/Database.php';

$projectPageNumber = '2';
$indexLocation = sprintf('Location: %s', ADMIN_PUBLIC_URL);
$projectsLocation = sprintf('Location: %s?page=%s', ADMIN_PUBLIC_URL, $projectPageNumber);


$user = new User();

if (empty($_POST['email']) || empty($_POST['mdp'])) {
    $_SESSION['error_login'] = 'Veuillez remplir tous les champs';
    header($indexLocation);
    exit();
}

$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$password = $_POST['mdp'];

try {
    $userData = $user->authenticate($email, $password);
    $isAdmin = $user->isAdmin($email);

    if(!$userData) {
        $_SESSION['error_login'] = 'Email ou mot de passe incorrect';
        header($indexLocation);
        exit();
    }

    if(!$isAdmin) {
        $_SESSION['error_login'] = 'Vous n\'êtes pas administrateur';
        header($indexLocation);
        exit();
    }

    $_SESSION['idUserAdmin'] = $userData['id_user'];
    header($projectsLocation);
    exit();

} catch (Exception $e) {
    error_log('Login error: ' . $e->getMessage());
    $_SESSION['error_login'] = 'Une erreur est survenue lors de la connexion.';
    header($indexLocation);
    exit();
}