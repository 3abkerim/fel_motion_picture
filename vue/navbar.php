<?php
$langQuery = 'lang=' . $lang;
?>
<nav class="navbar navbar-expand-lg">
    <div style="overflow:visible" class="container-fluid">
        <a class="ms-3" href="#">
            <img src="../public/assets/images/logo/FEL_logo.png" width="90" height="auto" alt="fel-motion-picture-logo">
        </a>

        <!--

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
-->

        <button class="hamburger--elastic navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto me-md-5 mb-2 mb-lg-0">
                <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home'; ?>
                <li class="nav-item">
                    <a class="nav-link <?= ($page == 'home') ? 'active' : '' ?>" aria-current="page" href="../public/index.php?<?= $langQuery ?>"><?= $translations['home'] ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($page == '2') ? 'active' : '' ?>" href="../public/index.php?page=2&<?= $langQuery ?>"><?= $translations['projects'] ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($page == '3') ? 'active' : '' ?>" href="../public/index.php?page=3&<?= $langQuery ?>"><?= $translations['services'] ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($page == '4') ? 'active' : '' ?>" href="../public/index.php?page=4&<?= $langQuery ?>"><?= $translations['about us'] ?> </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($page == '5') ? 'active' : '' ?>" href="../public/index.php?page=5&<?= $langQuery ?>"><?= $translations['contact'] ?></a>
                </li>


                <!-- Language Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-language" id="languageIcon"></i>
                    </a>

                    <?php
                    $urlComponents = parse_url($_SERVER['REQUEST_URI']);
                    $queryParams = [];
                    if (isset($urlComponents['query'])) {
                        parse_str($urlComponents['query'], $queryParams);
                    }

                    // Set the language parameters
                    $queryParams['lang'] = 'en';
                    // Rebuild the query string with the new language parameter
                    $enUrl = $urlComponents['path'] . '?' . http_build_query($queryParams);

                    $queryParams['lang'] = 'fr';
                    $frUrl = $urlComponents['path'] . '?' . http_build_query($queryParams);
                    ?>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?= htmlspecialchars($enUrl); ?>">EN</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="<?= htmlspecialchars($frUrl); ?>">FR</a></li>
                    </ul>
                </li>

            </ul>

        </div>



    </div>

</nav>