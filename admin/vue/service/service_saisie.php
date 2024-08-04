<!-- Alert placeholder -->
<div class="alert-placeholder">
    <?php if (isset($_SESSION['success-add-service'])) : ?>
        <div class="alert alert-info mt-3">
            <?= htmlspecialchars($_SESSION['success-add-service']); ?>
            <?php unset($_SESSION['success-add-service']); ?>
        </div>
    <?php elseif (isset($_SESSION['fail-add-service'])) : ?>
        <div class="alert alert-warning mt-3">
            <?= htmlspecialchars($_SESSION['fail-add-service']); ?>
            <?php unset($_SESSION['fail-add-service']); ?>
        </div>
    <?php else : ?>
        <div class="alert mt-3 invisible">Placeholder</div>
    <?php endif; ?>
</div>
<!-- Alert placeholder -->


<!-- Form add service -->
<form action="../controlleur/traitement_ajout_service.php" method="post">
    <div class="container">
        <div class="row mt-2">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Titre du service *</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="frName" required value="<?php echo (isset($form_data['frName']) ? $form_data['frName'] : ''); ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Contenu *</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="frContent" required><?php echo (isset($form_data['frContent']) ? $form_data['frContent'] : ''); ?></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Service title *</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="enName" required value="<?php echo (isset($form_data['enName']) ? $form_data['enName'] : ''); ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Content *</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="enContent" required><?php echo (isset($form_data['enContent']) ? $form_data['enContent'] : ''); ?></textarea>
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