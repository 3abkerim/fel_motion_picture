<?php
if (!isset($_SESSION['idUserAdmin'])) {
    $indexLocation = sprintf('Location: %s', ADMIN_PUBLIC_URL);
    header($indexLocation);
    exit();
}
require CLASSES_PATH . '/Service.php';

$page = 5;
$sectionSaisie = 1;
$sectionGestion = 2;
$sectionServiceFiche = 3;

$saisieUrl = sprintf('%s/index.php?page=%d', ADMIN_PUBLIC_URL, $page);
$gestionUrl = sprintf('%s/index.php?page=%d&section=%d', ADMIN_PUBLIC_URL, $page, $sectionGestion);
$serviceFicheUrl = sprintf('%s/index.php?page=%d&section=%d', ADMIN_PUBLIC_URL, $page, $sectionServiceFiche);

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$service = new Service;
$serviceFr = $service->getByIdAndLang($id, 'fr');
$serviceEn = $service->getByIdAndLang($id, 'en');// if (!isset($_SESSION[''])) {
?>
<div class="row">
    <div class="col-12">
        <div class="titreGestion">
            Services
        </div>
    </div>
</div>

<ul class="nav nav-tabs navbiens">
    <li class="nav-item">
        <a class="nav-link <?= (!isset($_GET['section']) ? 'active' : ''); ?>" aria-current="page" href="<?= $saisieUrl; ?>">Saisie</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= (isset($_GET['section']) && $_GET['section'] == $sectionGestion ? 'active' : ''); ?>" aria-current="page" href="<?= $gestionUrl; ?>">Gestion</a>
    </li>
    <?php if (isset($_GET['section']) && $_GET['section'] == $sectionServiceFiche) { ?>
        <li class="nav-item">
            <a class="nav-link <?= ($_GET['section'] == $sectionServiceFiche ? 'active' : ''); ?>" aria-current="page" href="<?= $serviceFicheUrl; ?>"><?= htmlspecialchars($serviceFr['titre_service']); ?></a>
        </li>
    <?php } ?>
</ul>

<?php
if (!isset($_GET['section'])) {
    include('service_saisie.php');
} elseif ($_GET['section'] == $sectionGestion) {
    include('services_gestion.php');
} elseif ($_GET['section'] == $sectionServiceFiche) {
    include('service_fiche.php');
}