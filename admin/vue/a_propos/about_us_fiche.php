<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$aboutFr = $about->getByIdAndLang($id, 'fr');
$aboutEn = $about->getByIdAndLang($id, 'en');
?>

<!-- Alert placeholder -->
<div class="alert-placeholder">
    <?php if (isset($_SESSION['success-edit'])) : ?>
        <div class="alert alert-info mt-3">
            <?= htmlspecialchars($_SESSION['success-edit']); ?>
            <?php unset($_SESSION['success-edit']); ?>
        </div>
    <?php elseif (isset($_SESSION['fail-edit'])) : ?>
        <div class="alert alert-warning mt-3">
            <?= htmlspecialchars($_SESSION['fail-edit']); ?>
            <?php unset($_SESSION['fail-edit']); ?>
        </div>
    <?php else : ?>
        <div class="alert mt-3 invisible">Placeholder</div>
    <?php endif; ?>
</div>
<!-- Alert placeholder -->

<!-- Form add About us -->
<form action="<?= ADMIN_CONTROLLERS_URL ?>/a_propos/aProposEditController.php" method="post">
    <div class="container">
        <div class="row mt-2">
            <div class="col-md-6">
                <input type="hidden" name="idAbout" value="<?= $id; ?>">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Titre *</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="frName" required value="<?= $aboutFr['title']; ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Contenu *</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="frContent" required><?= $aboutFr['about_us']; ?></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Title *</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="enName" required value="<?= $aboutEn['title']; ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Content *</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="enContent" required><?= $aboutEn['about_us']; ?></textarea>
                </div>
            </div>
            <hr>
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-info">Modifier</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Form add about us -->