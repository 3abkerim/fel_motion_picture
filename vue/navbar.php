<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="ms-3" href="#">
            <img src="../public/assets/images/logo/FEL_logo.png" width="90" height="auto" alt="fel-motion-picture-logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto me-md-5 mb-2 mb-lg-0">
                <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home'; ?>
                <li class="nav-item">
                    <a class="nav-link <?= ($page == 'home') ? 'active' : '' ?>" aria-current="page" href="../public/index.php">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($page == '2') ? 'active' : '' ?>" href="../public/index.php?page=2">PROJECTS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($page == '3') ? 'active' : '' ?>" href="../public/index.php?page=3">SERVICES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($page == '4') ? 'active' : '' ?>" href="../public/index.php?page=4">ABOUT US</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($page == '5') ? 'active' : '' ?>" href="../public/index.php?page=5">CONTACT</a>
                </li>
            </ul>
        </div>
    </div>
</nav>