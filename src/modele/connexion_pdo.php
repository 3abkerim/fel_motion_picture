<?php
try {
    $bdd = new PDO(
        "mysql:host=localhost;dbname=fel_motion_picture;charset=UTF8",
        "root",
        "root"
    );
} catch (PDOException $e) {
    echo $e->getMessage();
    die();
}
