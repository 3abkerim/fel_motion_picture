<?php
require_once('../../../config.php');
session_start();
require CLASSES_PATH.'/HomeImages.php';
require CLASSES_PATH.'/Database.php';
$page = '7';
$section = '2';
$header = sprintf('Location: %s?page=%s&section=%s', ADMIN_PUBLIC_URL, $page,$section);
$homeImages = new HomeImages();

if (isset($_FILES['photo'])) {
    $filesWereUploaded = false;
    foreach ($_FILES['photo']['error'] as $error) {
        if ($error !== UPLOAD_ERR_NO_FILE) {
            $filesWereUploaded = true;
            break;
        }
    }

    if (!$filesWereUploaded) {
        $_SESSION['fail'] = 'Les photos n\'ont pas été bien ajoutées';
        header($header);
        exit();
    }

//    $base_url = "https://www.ecoleduchat.fr/public/assets/images/uploads/articles/";
//    $base_url = "http://localhost:8888/fml/public/assets/images/";

    foreach ($_FILES['photo']['name'] as $i => $name) {
        if ($_FILES['photo']['size'][$i] > 0) {
            $file_extension = pathinfo($name, PATHINFO_EXTENSION);
            $unique_file_name = time() . '_' . mt_rand() . '.' . $file_extension;
            $uploaded_file_path = IMAGES_PATH.$unique_file_name;

            if (move_uploaded_file($_FILES['photo']['tmp_name'][$i], $uploaded_file_path)) {
                $photo = $unique_file_name;
                echo "Calling insertImage function.<br>";
                $homeImages->insertImageWithOrder($photo);
                $_SESSION['success'] = 'Les photos one été bien ajoutées';
            }
        }
    }
}
header($header);
exit();
