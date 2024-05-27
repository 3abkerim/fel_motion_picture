<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../../src/classes/Project.php';
require '../../src/classes/Database.php';

$project = new Project();

$id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : '';

if (isset($_FILES['photo'])) {
    if ($_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['error-upload'] = 'Error uploading file.';
        header('Location: ../public/index.php?page=2&section=4&id=' . $id);
        exit();
    }

    $upload_directory = '../../public/assets/images/uploads/';
    $name = $_FILES['photo']['name'];

    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $allowed_mime_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    $file_mime_type = mime_content_type($_FILES['photo']['tmp_name']);
    if (!in_array($file_mime_type, $allowed_mime_types)) {
        $_SESSION['error-upload'] = 'Unsupported file type.';
        header('Location: ../public/index.php?page=2&section=4&id=' . $id);
        exit();
    }

    if ($_FILES['photo']['size'] > 0) {
        $file_extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        if (!in_array($file_extension, $allowed_extensions)) {
            $_SESSION['error-upload'] = 'Invalid file extension.';
            header('Location: ../public/index.php?page=2&section=4&id=' . $id);
            exit();
        }

        $unique_file_name = time() . '_' . mt_rand() . '.' . $file_extension;
        $uploaded_file_path = $upload_directory . $unique_file_name;

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaded_file_path)) {
            $photo = $unique_file_name;

            $project->setImage($photo, $id);

            $_SESSION['success-edit-img'] = 'The image has been successfully updated.';
            header('Location: ../public/index.php?page=2&section=4&id=' . $id);
            exit();
        } else {
            $_SESSION['error-upload'] = 'Failed to move uploaded file.';
            header('Location: ../public/index.php?page=2&section=4&id=' . $id);
            exit();
        }
    }
}
