<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$categorieFr = $categorie->getByIdAndLang($id, 'fr');
$categorieEn = $categorie->getByIdAndLang($id, 'en');
?>

<!-- Alert placeholder -->
<div class="alert-placeholder">
    <?php if (isset($_SESSION['success-edit-categ'])) : ?>
        <div class="alert alert-info mt-3">
            <?= htmlspecialchars($_SESSION['success-edit-categ']); ?>
            <?php unset($_SESSION['success-edit-categ']); ?>
        </div>
    <?php elseif (isset($_SESSION['fail-edit-categ'])) : ?>
        <div class="alert alert-warning mt-3">
            <?= htmlspecialchars($_SESSION['fail-edit-categ']); ?>
            <?php unset($_SESSION['fail-edit-categ']); ?>
        </div>
    <?php else : ?>
        <div class="alert mt-3 invisible">Placeholder</div>
    <?php endif; ?>
</div>
<!-- Alert placeholder -->

<form action="../../controller/categorie/traitement_edit_categ.php" method="post">
    <div class="container">
        <div class="row mt-1">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Category name *</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="enCateg" placeholder="" value="<?= $categorieEn['project_type']; ?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nom du catégorie *</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="frCateg" placeholder="" value="<?= $categorieFr['project_type']; ?>" required>
                </div>
            </div>
        </div>
        <hr>
        <input type="hidden" name="idCateg" value="<?= $id; ?>">
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center"> <button type="submit" class="btn btn-info">Mettre à jour</button>
            </div>
        </div>
    </div>
</form>