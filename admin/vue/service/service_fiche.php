<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$serviceFr = $service->getByIdAndLang($id, 'fr');
$serviceEn = $service->getByIdAndLang($id, 'en');
?>

<!-- Alert placeholder -->
<div class="alert-placeholder">
    <?php if (isset($_SESSION['success-edit-service'])) : ?>
        <div class="alert alert-info mt-3">
            <?= htmlspecialchars($_SESSION['success-edit-service']); ?>
            <?php unset($_SESSION['success-edit-service']); ?>
        </div>
    <?php elseif (isset($_SESSION['fail-edit-service'])) : ?>
        <div class="alert alert-warning mt-3">
            <?= htmlspecialchars($_SESSION['fail-edit-service']); ?>
            <?php unset($_SESSION['fail-edit-service']); ?>
        </div>
    <?php else : ?>
        <div class="alert mt-3 invisible">Placeholder</div>
    <?php endif; ?>
</div>
<!-- Alert placeholder -->

<!-- Form add service -->
<form action="<?= ADMIN_CONTROLLERS_URL ?>/service/traitement_edit_service.php" method="post">
    <div class="container">
        <div class="row mt-2">
            <div class="col-md-6">
                <input type="hidden" name="idService" value="<?= $id; ?>">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Titre du service *</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="frName" required value="<?= $serviceFr['titre_service']; ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Contenu *</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="frContent" required><?= $serviceFr['info_service']; ?></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Service title *</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="enName" required value="<?= $serviceEn['titre_service']; ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Content *</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="enContent" required><?= $serviceEn['info_service']; ?></textarea>
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
<!-- Form add service -->