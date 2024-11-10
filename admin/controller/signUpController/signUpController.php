<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../../../config.php');
require CLASSES_PATH . '/User.php';
require CLASSES_PATH . '/Database.php';

$page = '3';
$headerInscription = sprintf('Location: %s?page=%s', ADMIN_PUBLIC_URL, $page);
$headerConnexion = sprintf('Location: %s', ADMIN_PUBLIC_URL);

$nom = ucfirst( htmlspecialchars($_POST['nom']));
$prenom = ucfirst(htmlspecialchars($_POST['prenom']));
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$mdp = htmlspecialchars($_POST['mdp']);
$confirmationMdp = htmlspecialchars($_POST['ConfirmationMdp']);

//$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
//$recaptcha_secret = '6LePuB4nAAAAAMeZK8MJcR2ZJfcSijgeLbd5BbDC';
//$recaptcha_response = $_POST['g-recaptcha-response'];
//
//$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
//$recaptchaJson = json_decode($recaptcha);
//
//if ($recaptchaJson->success==true && $recaptchaJson->score >= 0.5 && $recaptchaJson->action=='submit') {

    if (empty($nom)) {
        $_SESSION['error_signUp'] = 'Nom est requis!';
        $_SESSION['form_data_inscription'] = $_POST;
        header($headerInscription);
    } elseif (empty($prenom)) {
        $_SESSION['error_signUp'] = 'Prenom est requis!';
        $_SESSION['form_data_inscription'] = $_POST;
        header($headerInscription);
    } elseif (!$email) {
        $_SESSION['error_signUp'] = 'Email non valide!';
        $_SESSION['form_data_inscription'] = $_POST;
        header($headerInscription);
    } elseif (empty($mdp)) {
        $_SESSION['error_signUp'] = 'Mot de passe est requis!';
        $_SESSION['form_data_inscription'] = $_POST;
        header($headerInscription);
    } elseif (empty($confirmationMdp)) {
        $_SESSION['error_signUp'] = 'Confirmation de mot de passe est requise!';
        $_SESSION['form_data_inscription'] = $_POST;
        header($headerInscription);
    } else {
        $user = new User();
        $userExists = $user->isUserExists($email);

        if ($userExists){
            $_SESSION['error_signUp'] = 'Email existe déja, utilisez un autre email.';
            $_SESSION['form_data_inscription'] = $_POST;
            header($headerInscription);
        } else {
            if (strlen($mdp)>=6) {
                if ($mdp===$confirmationMdp) {
                    $mdp = password_hash($mdp,PASSWORD_DEFAULT);
                    $id_user = $user->createUser($nom, $prenom, $email, $mdp);
                    $_SESSION['success_signUp'] = 'Vous êtes bien inscrit. Veuillez attendre à un administrateur de valider votre demande.';                    header($headerConnexion);
                    exit();
                } else {
                    $_SESSION['error_signUp'] = 'Les mots de passe ne sont pas identiques.';
                    $_SESSION['form_data_inscription'] = $_POST;
                    header($headerInscription);
                }
            } else {
                $_SESSION['error_signUp'] = 'Le mot de passe est trop court !';
                $_SESSION['form_data_inscription'] = $_POST;
                header($headerInscription);
            }
        }
    }
//} else{
//    $_SESSION['form_data_inscription'] = $_POST;
//    $_SESSION['erreur']='La vérification reCAPTCHA a échoué. Veuillez réessayer.';
//    header($headerInscription);
//    exit();
//}

