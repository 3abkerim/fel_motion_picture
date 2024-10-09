<!-- Alert placeholder -->
<div class="alert-placeholder">
    <?php if (isset($_SESSION['success-add-categ'])) : ?>
        <div class="alert alert-info mt-3">
            <?= htmlspecialchars($_SESSION['success-add-categ']); ?>
            <?php unset($_SESSION['success-add-categ']); ?>
        </div>
    <?php elseif (isset($_SESSION['fail-add-categ'])) : ?>
        <div class="alert alert-warning mt-3">
            <?= htmlspecialchars($_SESSION['fail-add-categ']); ?>
            <?php unset($_SESSION['fail-add-categ']); ?>
        </div>
    <?php else : ?>
        <div class="alert mt-3 invisible">Placeholder</div>
    <?php endif; ?>
</div>
<!-- Alert placeholder -->


<!-- Form add categorie -->
<form action="<?= ADMIN_CONTROLLERS_URL ?>/categorie/traitement_ajout_categ.php" method="post">
    <div class="container">
        <div class="row mt-2">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Category name *</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="enCateg" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nom de catégorie *</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="frCateg" required>
                </div>

            </div>
        </div>
        <hr>
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center"> <button type="submit" class="btn btn-info">Ajouter</button>
            </div>
        </div>
    </div>
</form>
<!-- Form add categorie -->