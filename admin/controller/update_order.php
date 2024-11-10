<?php
session_start();
require '../../src/classes/Project.php';
require '../../src/classes/Database.php';
require '../../src/classes/Service.php';
require '../../src/classes/About.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    // Get the data from the POST request and decode it from JSON to PHP array
    $input = json_decode(file_get_contents('php://input'), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("JSON Decode Error: " . json_last_error_msg());
    }
    $table = $input['table'];
    $data = $input['data'];

    // Validate input
    if (empty($table) || empty($data)) {
        throw new Exception("Invalid input.");
    }

    // Mapping of table names to class names
    $tableClassMap = [
        'project' => 'Project',
        'service' => 'Service',
        'about' => 'About',
    ];

    // Check if the table name is valid
    if (!array_key_exists($table, $tableClassMap)) {
        throw new Exception("Invalid table name.");
    }

    // Establish database connection
    $database = new Database();
    $db = $database->connect();
    if (!$db) {
        throw new Exception("Database connection failed.");
    }

    // Dynamically instantiate the appropriate class
    $className = $tableClassMap[$table];
    if (!class_exists($className)) {
        throw new Exception("Class $className not found.");
    }
    $classInstance = new $className($db);

    // Update order using the appropriate class method
    if (!method_exists($classInstance, 'updateOrder')) {
        throw new Exception("Method updateOrder not found in class $className.");
    }
    $result = $classInstance->updateOrder($data);

} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>