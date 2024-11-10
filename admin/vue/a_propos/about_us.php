<?php
if (!isset($_SESSION['idUserAdmin'])) {
    $indexLocation = sprintf('Location: %s', ADMIN_PUBLIC_URL);
    header($indexLocation);
    exit();
}
require CLASSES_PATH . '/About.php';

$page = 6;
$sectionSaisie = 1;
$sectionGestion = 2;
$sectionAboutFiche = 3;

$saisieUrl = sprintf('%s/index.php?page=%d', ADMIN_PUBLIC_URL, $page);
$gestionUrl = sprintf('%s/index.php?page=%d&section=%d', ADMIN_PUBLIC_URL, $page, $sectionGestion);
$aboutFicheUrl = sprintf('%s/index.php?page=%d&section=%d', ADMIN_PUBLIC_URL, $page, $sectionAboutFiche);

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$about = new About();
$aboutFr = $about->getByIdAndLang($id, 'fr');
$aboutEn = $about->getByIdAndLang($id, 'en');
?>
    <div class="row">
        <div class="col-12">
            <div class="titreGestion">
                À propos
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
        <?php if (isset($_GET['section']) && $_GET['section'] == $sectionAboutFiche) { ?>
            <li class="nav-item">
                <a class="nav-link <?= ($_GET['section'] == $sectionAboutFiche ? 'active' : ''); ?>" aria-current="page" href="<?= $aboutFicheUrl; ?>"><?= htmlspecialchars($aboutFr['title']); ?></a>
            </li>
        <?php } ?>
    </ul>

<?php
if (!isset($_GET['section'])) {
    include('about_us_saisie.php');
} elseif ($_GET['section'] == $sectionGestion) {
    include('about_us_gestion.php');
} elseif ($_GET['section'] == $sectionAboutFiche) {
    include('about_us_fiche.php');
}