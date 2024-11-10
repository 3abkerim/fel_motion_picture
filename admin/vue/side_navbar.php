<?php
require_once('../../config.php');
require_once CLASSES_PATH . '/User.php';

$idFromSession = $_SESSION['idUserAdmin'];
$userSession = new User();

try {
    $userById = $userSession->getById($idFromSession);
} catch (Exception $e) {
    throw new Exception("Unable to retrieve user id: " . $e->getMessage());
}

$currentPage = $_GET['page'] ?? '';
?>

<div class="d-flex flex-column ParentSideBar align-items-center align-items-sm-start px-3 pt-2">
    <a href="<?= ADMIN_PUBLIC_URL ?>/index.php?page=2" class="border-end-0 d-inline-block text-truncate col-12 navBtn <?php echo $currentPage == '2' ? 'active' : ''; ?>" data-bs-parent="#sidebar">
        <span><i class="fa-solid fa-film me-1"></i>Projets</span>
    </a>
    <a href="<?= ADMIN_PUBLIC_URL ?>/index.php?page=4" class="border-end-0 d-inline-block text-truncate col-12 navBtn <?php echo $currentPage == '4' ? 'active' : ''; ?>" data-bs-parent="#sidebar">
        <span><i class="fa-solid fa-layer-group me-1"></i>Catégories</span>
    </a>
    <a href="<?= ADMIN_PUBLIC_URL ?>/index.php?page=5" class="border-end-0 d-inline-block text-truncate col-12 navBtn <?php echo $currentPage == '5' ? 'active' : ''; ?>" data-bs-parent="#sidebar">
        <span><i class="fa-solid fa-handshake-angle me-1"></i>Services</span>
    </a>
    <a href="<?= ADMIN_PUBLIC_URL ?>/index.php?page=6" class="border-end-0 d-inline-block text-truncate col-12 navBtn <?php echo $currentPage == '6' ? 'active' : ''; ?>" data-bs-parent="#sidebar">
        <span><i class="fa-solid fa-circle-info me-1"></i>À propos</span>
    </a>
    <a href="<?= ADMIN_PUBLIC_URL ?>/index.php?page=7" class="border-end-0 d-inline-block text-truncate col-12 navBtn <?php echo $currentPage == '7' ? 'active' : ''; ?>" data-bs-parent="#sidebar">
        <span><i class="fa-solid fa-house me-1"></i>Page d'accueil</span>
    </a>
    <a href="<?= ADMIN_PUBLIC_URL ?>/index.php?page=8" class="border-end-0 d-inline-block text-truncate col-12 navBtn <?php echo $currentPage == '8' ? 'active' : ''; ?>" data-bs-parent="#sidebar">
        <span><i class="fa-solid fa-user-tie me-1"></i>Admins</span>
    </a>
    <a href="<?= ADMIN_PUBLIC_URL ?>/index.php?page=9" class="border-end-0 d-inline-block text-truncate col-12 navBtn <?php echo $currentPage == '9' ? 'active' : ''; ?>" data-bs-parent="#sidebar">
        <span><i class="fa-solid fa-message me-1"></i>Messagerie</span>
    </a>

    <div class="dropup dropposition mb-4 mt-auto testUser">
        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img class="rounded-circle me-1" width="30" height="30" src="<?= ADMIN_ASSETS_URL ?>/images/user.png" alt="user-logo" />
            <span class="d-none d-sm-inline mx-1"><?= $userById['prenom'] ?> <?= $userById['nom'] ?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <!-- <li><a class="dropdown-item" href="#">Mon compte</a></li> -->
            <!-- <li>
                <hr class="dropdown-divider" />
            </li> -->
            <li><a class="dropdown-item text-white" href="<?= ADMIN_CONTROLLERS_URL ?>/log_out/logOutController.php">Déconnexion</a></li>
        </ul>
    </div>
</div>