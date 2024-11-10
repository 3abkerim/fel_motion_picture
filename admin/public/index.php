<?php
ob_start();
session_start();
require '../../config.php';
require CLASSES_PATH . '/Database.php';

const BOOTSTRAP_JS = ADMIN_ASSETS_URL . '/bootstrap/js/bootstrap.bundle.min.js';
const BOOTSTRAP_CSS = ADMIN_ASSETS_URL . '/bootstrap/css/bootstrap.min.css';
const JS = ADMIN_ASSETS_URL . '/js/js.js';
const CSS = ADMIN_ASSETS_URL . '/css/css.css';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/0f0b5058e5.js" crossorigin="anonymous"></script>
    <title>Backoffice : FEL Motion Picture</title>
    <link rel="stylesheet" href="<?= BOOTSTRAP_CSS ?>" />
    <link rel="stylesheet" href="<?= CSS ?>" />
    <link rel="icon" href="#" />
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
</head>

<body>
<div class="container-fluid ">
    <?php
    if (isset($_GET['page'])) {
        if ($_GET['page'] != 3) { ?>
            <div class="row navBo2 testRelative2">
                <div class="col-12">
                    <?php include '../vue/header.php'; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2 flex-md-column navBo d-none d-lg-block border-0 rounded-0">
                    <div class="row navBo">
                        <?php include '../vue/side_navbar.php'; ?>
                    </div>
                </div>
                <div class="col-lg-10 testRelative">
        <?php
        } else {
            echo '<div class="w-25 m-auto bg-secondary rounded">';
        }
        if ($_GET['page'] == 2) {
            include ADMIN_VUE_PATH . '/project/projets.php';
        } elseif ($_GET['page'] == 3) {
            include ADMIN_VUE_PATH . '/signUp/signUp.php';
        } elseif ($_GET['page'] == 4) {
            include ADMIN_VUE_PATH . '/categorie/categories.php';
        } elseif ($_GET['page'] == 5) {
            include ADMIN_VUE_PATH . '/service/services.php';
        } elseif ($_GET['page'] == 6) {
            include ADMIN_VUE_PATH . '/a_propos/about_us.php';
        } elseif ($_GET['page'] == 7) {
            include ADMIN_VUE_PATH . '/accueil/accueil.php';
        } elseif ($_GET['page'] == 8) {
            include ADMIN_VUE_PATH . '/admins/admins.php';
        } elseif ($_GET['page'] == 9) {
            include ADMIN_VUE_PATH . '/messagerie/messagerie.php';
        }

        echo '</div>';

        if ($_GET['page'] != 3) {
            echo '</div>';
        }

        } else { ?>
            <div class="w-25 m-auto bg-secondary rounded">
                <?php include ADMIN_VUE_PATH . '/log_in/log_in.php'; ?>
            </div>
            <?php
        }
        ?>
        </div>
        <script src="<?= BOOTSTRAP_JS ?>"></script>
        <script src="<?= JS ?>"></script>
</body>

</html>