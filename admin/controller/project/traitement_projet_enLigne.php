<?php
require '../../../src/classes/Project.php';
require '../../../src/classes/Database.php';

if (isset($_POST['id']) && isset($_POST['publie'])) {
    $id = $_POST['id'];
    $publie = $_POST['publie'];

    $project = new Project();
    $result = $project->online($id, $publie);

    if ($result === true) {
        echo "Success";
    } else {
        echo $result; 
    }
}

