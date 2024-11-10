<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$homepageText = new HomepageText();
$textFr = $homepageText->getByLang('fr');
$textEn = $homepageText->getByLang('en');
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

<form action="<?= ADMIN_CONTROLLERS_URL ?>/homepage/homepageEditTextController.php" method="post">
    <div class="container">
        <div class="row mt-1">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Content *</label>
                    <textarea class="form-control" name="enContent" id="exampleFormControlTextarea1" rows="10" required><?= $textEn['text'] ?></textarea>
                </div>

            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Contenu *</label>
                    <textarea class="form-control" name="frContent" id="exampleFormControlTextarea1" rows="10" required><?= $textFr['text'] ?></textarea>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center"> <button type="submit" class="btn btn-info">Mettre à jour</button>
            </div>
        </div>
    </div>
</form>