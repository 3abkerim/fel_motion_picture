<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/css.css" />
    <link rel="icon" href="assets/images/Logo-principal.jpg" />
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include '../vue/navbar.php';

    if (!isset($_GET['page'])) {
        include('../vue/home.php');
    } else {
        if ($_GET['page'] == 2) {
            include('../vue/chats.php');
        } elseif ($_GET['page'] == 3) {
            include('../vue/fiche_chat.php');
        } elseif ($_GET['page'] == 4) {
            include('../vue/articles.php');
        } elseif ($_GET['page'] == 5) {
            include('../vue/article.php');
        }
    }
    include '../vue/footer.php';

    ?>

    <script src="assets/js/js.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>