<!-- Alert placeholder -->
<div class="alert-placeholder">
    <?php if (isset($_SESSION['success-add-text'])) : ?>
        <div class="alert alert-info mt-3">
            <?= htmlspecialchars($_SESSION['success-add-text']); ?>
            <?php unset($_SESSION['success-add-text']); ?>
        </div>
    <?php elseif (isset($_SESSION['fail-add-text'])) : ?>
        <div class="alert alert-warning mt-3">
            <?= htmlspecialchars($_SESSION['fail-add-text']); ?>
            <?php unset($_SESSION['fail-add-text']); ?>
        </div>
    <?php else : ?>
        <div class="alert mt-3 invisible">Placeholder</div>
    <?php endif; ?>
</div>
<!-- Alert placeholder -->

<!-- Form add service -->
<form action="<?= ADMIN_CONTROLLERS_URL ?>/a_propos/aProposCreateController.php" method="post">
    <div class="container">
        <div class="row mt-2">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Titre *</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="frName" required value="<?= (isset($form_data['frName']) ? $form_data['frName'] : ''); ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Contenu *</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" required name="frContent"><?= (isset($form_data['frContent']) ? $form_data['frContent'] : ''); ?></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Title *</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" required name="enName" value="<?php echo (isset($form_data['enName']) ? $form_data['enName'] : ''); ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Content *</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" required rows="3" name="enContent"><?= (isset($form_data['enContent']) ? $form_data['enContent'] : ''); ?></textarea>
                </div>
            </div>
            <hr>
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-info">Ajouter</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Form add service -->