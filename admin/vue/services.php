<?php
require '../../src/classes/Service.php';

// if (!isset($_SESSION[''])) {
//     header('Location:../public/index.php?');
//     exit();
// }
?>
<div class="row">
    <div class="col-12">
        <div class="titreGestion">
            Services
        </div>
    </div>
</div>

<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$service = new Service;
$serviceFr = $service->getByIdAndLang($id, 'fr');
$serviceEn = $service->getByIdAndLang($id, 'en');
?>



<ul class="nav nav-tabs navbiens mt-3">
    <li class="nav-item">
        <a class="nav-link <?php echo (!isset($_GET['section']) ? ' active' : ''); ?>" aria-current="page" href="../public/index.php?page=5">Saisie</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo (isset($_GET['section']) && $_GET['section'] === '2' ? ' active' : ''); ?>" aria-current="page" href="../public/index.php?page=5&section=2">Gestion</a>
    </li>
    <?php if (isset($_GET['section']) && ($_GET['section'] === '3')) { ?>
        <li class="nav-item">
            <a class="nav-link <?php echo (isset($_GET['section']) && $_GET['section'] === '3' ? ' active' : ''); ?>" aria-current="page" href="../public/index.php?page=5&section=3"><?= $serviceFr['titre_service']; ?></a>
        </li>
    <?php } ?>
</ul>

<?php
if (!isset($_GET['section'])) {
    include('../vue/service_saisie.php');
} else {
    if ($_GET['section'] == 2) {
        include('../vue/services_gestion.php');
    }
    if ($_GET['section'] == 3) {
        include('../vue/service_fiche.php');
    }
}

?>