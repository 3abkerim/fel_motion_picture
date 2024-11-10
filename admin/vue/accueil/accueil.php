<?php
if (!isset($_SESSION['idUserAdmin'])) {
    $indexLocation = sprintf('Location: %s', ADMIN_PUBLIC_URL);
    header($indexLocation);
    exit();
}
require CLASSES_PATH . '/HomeImages.php';
require CLASSES_PATH . '/HomepageText.php';
require CLASSES_PATH . '/Sponsor.php';

$page = 7;
$sectionPresentation = 1;
$sectionPhotos = 2;
$sectionPartenaires = 3;

$presentationUrl = sprintf('%s/index.php?page=%d', ADMIN_PUBLIC_URL, $page);
$photosUrl = sprintf('%s/index.php?page=%d&section=%d', ADMIN_PUBLIC_URL, $page, $sectionPhotos);
$partenairesUrl = sprintf('%s/index.php?page=%d&section=%d', ADMIN_PUBLIC_URL, $page, $sectionPartenaires);

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$homepageImages = new HomeImages();
$sponsor = new Sponsor();
?>
    <div class="row">
        <div class="col-12">
            <div class="titreGestion">
                Page d'accueil
            </div>
        </div>
    </div>

    <ul class="nav nav-tabs navbiens">
        <li class="nav-item">
            <a class="nav-link <?= (!isset($_GET['section']) ? 'active' : ''); ?>" aria-current="page" href="<?= $presentationUrl; ?>">Présentation</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (isset($_GET['section']) && $_GET['section'] == $sectionPhotos ? 'active' : ''); ?>" aria-current="page" href="<?= $photosUrl; ?>">Photos homepage</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= (isset($_GET['section']) && $_GET['section'] == $sectionPartenaires ? 'active' : ''); ?>" aria-current="page" href="<?= $partenairesUrl; ?>">Partenaires</a>
        </li>
    </ul>

<?php
if (!isset($_GET['section'])) {
    include('accueil_presentation.php');
} elseif ($_GET['section'] == $sectionPhotos) {
    include('accueil_photos.php');
} elseif ($_GET['section'] == $sectionPartenaires) {
    include('accueil_partenaires.php');
}