<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();
require '../../src/classes/User.php';


if (isset($_POST['email']) && isset($_POST['mdp'])) {
    $email = htmlspecialchars($_POST['email']);
    $mdp = htmlspecialchars($_POST['mdp']);

    $user = new User();
    $userExists = $user->adminExists($email);

    if ($userExists) {
        if (password_verify($mdp, $userExists['mdp']))
            $_SESSION['idUserAdmin'] = $userExists['id_user'];
        header('Location:../public/index.php?page=3');
        exit();
    } else {
        $_SESSION['error_login'] = 'Email ou mot de passe incorrect';
        header('Location:../public/index.php');
    }
} else {
    $_SESSION['error_login'] = 'Veuillez remplir tous les champs';
    header('Location:../public/index.php');
}

echo "<pre>";
print_r($_SESSION);
echo "</pre>";
