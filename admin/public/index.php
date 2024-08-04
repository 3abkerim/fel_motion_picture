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
    <title>index</title>
    <link rel="stylesheet" href="<?= BOOTSTRAP_CSS ?>" />
    <link rel="stylesheet" href="<?= CSS ?>" />
    <link rel="icon" href="#" />
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
</head>

<body>
<div class="container-fluid ">
    <?php
    if (isset($_GET['page'])) { ?>
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
                if ($_GET['page'] == 2) {
                    include ADMIN_VUE_PATH . '/project/projets.php';
                } elseif ($_GET['page'] == 3) {
                    include ADMIN_VUE_PATH . '/tableau_de_bord.php';
                } elseif ($_GET['page'] == 4) {
                    include ADMIN_VUE_PATH . '/categorie/categories.php';
                } elseif ($_GET['page'] == 5) {
                    include ADMIN_VUE_PATH . '/service/services.php';
                }
                ?>
            </div>
        </div>
        <?php
    } else { ?>
        <div class="row">
            <div class="col-12">
                <?php include ADMIN_VUE_PATH . '/connexion.php'; ?>
            </div>
        </div>
        <?php
    }
    ?>
</div>
<script src="<?= BOOTSTRAP_JS ?>"></script>
<script src="<?= JS ?>"></script>
</body>

</html>