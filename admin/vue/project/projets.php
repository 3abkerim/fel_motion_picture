<?php
require CLASSES_PATH . '/Project.php';
require CLASSES_PATH . '/Categorie.php';

// if (!isset($_SESSION[''])) {
//     header('Location: ../public/index.php?');
//     exit();
// }
?>
    <div class="row">
        <div class="col-12">
            <div class="titreGestion">
                Projets
            </div>
        </div>
    </div>

<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$project = new Project;
$categorie = new Categorie;
$projectById = $project->getById($id);
?>

    <ul class="nav nav-tabs navbiens mt-3">
        <li class="nav-item">
            <a class="nav-link <?php echo (!isset($_GET['section']) ? ' active' : ''); ?>" aria-current="page" href="<?= ADMIN_PUBLIC_URL ?>/index.php?page=2">Saisie</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo (isset($_GET['section']) && $_GET['section'] === '2' ? ' active' : ''); ?>" aria-current="page" href="<?= ADMIN_PUBLIC_URL ?>/index.php?page=2&section=2">Gestion</a>
        </li>
        <?php if (isset($_GET['section']) && ($_GET['section'] === '3')) { ?>
            <li class="nav-item">
                <a class="nav-link <?php echo (isset($_GET['section']) && $_GET['section'] === '3' ? ' active' : ''); ?>" aria-current="page" href="<?= ADMIN_PUBLIC_URL ?>/index.php?page=2&section=3"><?= $projectById['project_name']; ?></a>
            </li>
        <?php } ?>
        <?php if (isset($_GET['section']) && ($_GET['section'] === '4')) { ?>
            <li class="nav-item">
                <a class="nav-link <?php echo (isset($_GET['section']) && $_GET['section'] === '4' ? ' active' : ''); ?>" aria-current="page" href="<?= ADMIN_PUBLIC_URL ?>/index.php?page=2&section=4">Photo de "<?= $projectById['project_name']; ?>"</a>
            </li>
        <?php } ?>
    </ul>

<?php
if (!isset($_GET['section'])) {
    include('projet_saisie.php');
} else {
    if ($_GET['section'] == 2) {
        include('projets_gestion.php');
    }
    if ($_GET['section'] == 3) {
        include('projet_fiche.php');
    }
    if ($_GET['section'] == 4) {
        include('projet_saisie_photo.php');
    }
}
?>