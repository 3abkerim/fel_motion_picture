<?php
require_once('../../../config.php');
session_start();
require CLASSES_PATH.'/Sponsor.php';
require CLASSES_PATH.'/Database.php';

$page = '7';
$section = '3';
$header = sprintf('Location: %s?page=%s&section=%s', ADMIN_PUBLIC_URL, $page, $section);
$sponsor = new Sponsor();

if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $description = isset($_POST['description']) ? $_POST['description'] : '';

    $file_extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
    $unique_file_name = time() . '_' . mt_rand() . '.' . $file_extension;
    $uploaded_file_path = IMAGES_PATH . $unique_file_name;

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaded_file_path)) {
        $photo = $unique_file_name;
        echo "Calling insertImage function.<br>";

        $sponsor->insertSponsor($description, $photo);
        $_SESSION['success'] = 'La photo a été bien ajoutée';
    } else {
        $_SESSION['fail'] = 'Erreur lors du téléchargement de la photo';
    }
} else {
    $_SESSION['fail'] = 'La photo n\'a pas été bien ajoutée';
}

header($header);
exit();