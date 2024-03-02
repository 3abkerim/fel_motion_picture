<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$projetFr = $project->getByIdFr($id, 'fr');
$projetEn = $project->getByIdEn($id, 'en');
?>

<!-- Alert placeholder -->
<div class="alert-placeholder">
    <?php if (isset($_SESSION['success-edit-project'])) : ?>
        <div class="alert alert-info mt-3">
            <?= htmlspecialchars($_SESSION['success-edit-project']); ?>
            <?php unset($_SESSION['success-edit-project']); ?>
        </div>
    <?php elseif (isset($_SESSION['fail-edit-project'])) : ?>
        <div class="alert alert-warning mt-3">
            <?= htmlspecialchars($_SESSION['fail-edit-project']); ?>
            <?php unset($_SESSION['fail-edit-project']); ?>
        </div>
    <?php else : ?>
        <div class="alert mt-3 invisible">Placeholder</div>
    <?php endif; ?>
</div>
<!-- Alert placeholder -->

<form action="" method="post">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Project Name *</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" required value="<?= $projetEn['project_name'] ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Content *</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" required><?= $projetEn['project_info'] ?></textarea>
                </div>

            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nom du projet *</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" required value="<?= $projetFr['project_name'] ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Contenu *</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" required> <?= $projetFr['project_info'] ?></textarea>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Date du projet *</label>
                    <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="" required value="<?= $projetEn['project_date'] ?> ">
                </div>
            </div>
            <div class=" col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Catégorie *</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected value="<?= $projetFr['id_project_type']; ?>"> <?= $projetFr['project_type']; ?></option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center"> <button class="btn btn-info">Mettre à jour</button>
            </div>
        </div>
    </div>
</form>