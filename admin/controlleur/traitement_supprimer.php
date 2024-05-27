<?php
session_start();
require '../../src/classes/Database.php';
require '../../src/classes/Categorie.php';
require '../../src/classes/Project.php';
require '../../src/classes/Service.php';

try {
    // Sanitize and validate the ID
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if (!$id) {
        throw new Exception("Invalid ID.");
    }

    // Sanitize and validate the page number
    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
    if (!$page) {
        throw new Exception("Invalid page number.");
    }

    // Define the mapping of page numbers to entity classes
    $pageEntityMap = [
        4 => 'Categorie',
        2 => 'Project',
        3 => 'Service'
    ];

    // Check if the page number is valid
    if (!array_key_exists($page, $pageEntityMap)) {
        throw new Exception("Invalid page number specified.");
    }

    // Get the entity class based on the page number
    $className = $pageEntityMap[$page];

    // Initialize database connection
    $database = new Database();
    $db = $database->getConnection();

    // Instantiate the appropriate class
    if (!class_exists($className)) {
        throw new Exception("Class $className not found.");
    }

    $entityInstance = new $className($db);

    // Perform the delete operation
    $entityInstance->delete($id);

    $_SESSION['success-delete'] = ucfirst(strtolower($className)) . ' has been successfully deleted.';
} catch (Exception $e) {
    $_SESSION['fail-delete'] = 'Failed to delete ' . strtolower($className) . '. ' . $e->getMessage();
}

// Redirect to the appropriate page and section
header('Location: ../public/index.php?page=' . $page . '&section=2');
exit();
?>
