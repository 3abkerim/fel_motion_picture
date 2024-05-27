<?php
ob_start();
session_start();
require '../../src/classes/Database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>index</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/css.css" />
  <link rel="icon" href="assets/images/logo-edc-noire-rvb-sans-fond.png" />
  <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            include '../vue/projets.php';
          } elseif ($_GET['page'] == 3) {
            include '../vue/tableau_de_bord.php';
          } elseif ($_GET['page'] == 4) {
            include '../vue/categories.php';
          } elseif ($_GET['page'] == 5) {
            include '../vue/services.php';
          }
          ?>
        </div>
      </div>
    <?php
    } else { ?>
      <div class="row">
        <div class="col-12">
          <?php include '../vue/connexion.php'; ?>
        </div>
      </div>
    <?php
    }
    ?>
  </div>

  <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/js.js"></script>
</body>

</html>