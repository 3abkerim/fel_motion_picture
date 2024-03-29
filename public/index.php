<?php
session_start();

if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    $_SESSION['lang'] = $lang;
} elseif (isset($_SESSION['lang'])) {
    $lang = $_SESSION['lang'];
} else {
    $lang = 'fr';
}

$translations = require '../languages/' . $lang . '.php';

require '../src/classes/Database.php';

?>

<!DOCTYPE html>
<html lang="<?= $lang; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $translations['meta_title']; ?></title>
    <!-- LINKS -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
    <link href="assets/hamburgers-master/dist/hamburgers.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/css.css" />
    <link rel="icon" href="assets/images/logo/FEL_logo-modified_black_small.png" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Hreflang links for SEO -->
    <link rel="alternate" hreflang="fr" href="http://yourwebsite.com/<?php echo $lang === 'fr' ? '' : '?lang=fr'; ?>" />
    <link rel="alternate" hreflang="en" href="http://yourwebsite.com/<?php echo $lang === 'en' ? '' : '?lang=en'; ?>" />
    <!-- SCRIPTS -->
    <script src="https://kit.fontawesome.com/0f0b5058e5.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>



</head>

<body>


    <?php
    include '../vue/navbar.php';

    if (!isset($_GET['page'])) {
        include('../vue/home.php');
    } else {
        if ($_GET['page'] == 2) {
            include('../vue/projets.php');
        } elseif ($_GET['page'] == 3) {
            include('../vue/services.php');
        } elseif ($_GET['page'] == 4) {
            include('../vue/about_us.php');
        } elseif ($_GET['page'] == 5) {
            include('../vue/contact.php');
        } elseif ($_GET['page'] == 6) {
            include('../vue/thank_you.php');
        } elseif ($_GET['page'] == 7) {
            include('../vue/credits.php');
        } elseif ($_GET['page'] == 8) {
            include('../vue/rgpd.php');
        } elseif ($_GET['page'] == 9) {
            include('../vue/cookies.php');
        } elseif ($_GET['page'] == 10) {
            include('../vue/mentions_legales.php');
        }
    }
    include '../vue/footer.php';
    ?>
    <script>
        AOS.init();
    </script>
    <script src="assets/js/js.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>