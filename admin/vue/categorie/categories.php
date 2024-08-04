<?php
require '../../src/classes/Categorie.php';

// if (!isset($_SESSION[''])) {
//     header('Location:../public/index.php?');
//     exit();
// }
?>
<div class="row">
    <div class="col-12">
        <div class="titreGestion">
            Catégories
        </div>
    </div>
</div>

<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$categorie = new Categorie;
$categorietById = $categorie->getByIdAndLang($id, 'fr');
?>



<ul class="nav nav-tabs navbiens mt-3">
    <li class="nav-item">
        <a class="nav-link <?php echo (!isset($_GET['section']) ? ' active' : ''); ?>" aria-current="page" href="../../public/index.php?page=4">Saisie</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo (isset($_GET['section']) && $_GET['section'] === '2' ? ' active' : ''); ?>" aria-current="page" href="../../public/index.php?page=4&section=2">Gestion</a>
    </li>
    <?php if (isset($_GET['section']) && ($_GET['section'] === '3')) { ?>
        <li class="nav-item">
            <a class="nav-link <?php echo (isset($_GET['section']) && $_GET['section'] === '3' ? ' active' : ''); ?>" aria-current="page" href="../../public/index.php?page=4&section=3"><?= $categorietById['project_type']; ?></a>
        </li>
    <?php } ?>
</ul>

<?php
if (!isset($_GET['section'])) {
    include('../vue/categorie_saisie.php');
} else {
    if ($_GET['section'] == 2) {
        include('../vue/categories_gestion.php');
    }
    if ($_GET['section'] == 3) {
        include('../vue/categorie_fiche.php');
    }
}

?>