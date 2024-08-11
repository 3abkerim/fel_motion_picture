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

<form action="<?= ADMIN_CONTROLLERS_URL ?>/project/traitement_edit_projet.php" method="post">
    <div class="container">
        <div class="row mt-1">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Project Name *</label>
                    <input type="text" name="enName" class="form-control" id="exampleFormControlInput1" placeholder="" required value="<?= $projetEn['project_name'] ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Content *</label>
                    <textarea class="form-control" name="enContent" id="exampleFormControlTextarea1" rows="3" required><?= $projetEn['project_info'] ?></textarea>
                </div>

            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nom du projet *</label>
                    <input type="text" name="frName" class="form-control" id="exampleFormControlInput1" placeholder="" required value="<?= $projetFr['project_name'] ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Contenu *</label>
                    <textarea class="form-control" name="frContent" id="exampleFormControlTextarea1" rows="3" required><?= $projetFr['project_info'] ?></textarea>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Date du projet *</label>
                    <?php
                    $date = DateTime::createFromFormat('Y-m-d', $projetEn['project_date']);
                    $formattedDate = $date->format('d/m/Y');
                    ?>
                    <input type="text" class="form-control" name="date" id="exampleFormControlInput1" placeholder="" required value="<?= htmlspecialchars($formattedDate, ENT_QUOTES, 'UTF-8') ?>">
                </div>
            </div>
            <div class=" col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Catégorie *</label>
                    <select class="form-select" aria-label="Default select example" name="categ">
                        <option selected value="<?= htmlspecialchars($projetFr['id_project_type'], ENT_QUOTES, 'UTF-8'); ?>">
                            <?= htmlspecialchars($projetFr['project_type'], ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                        <?php foreach ($categorie->getAll() as $cat) {
                            if ($cat['id_project_type'] == $projetFr['id_project_type']) continue;
                        ?>
                            <option value="<?= htmlspecialchars($cat['id_project_type'], ENT_QUOTES, 'UTF-8'); ?>">
                                <?= htmlspecialchars($cat['project_type'], ENT_QUOTES, 'UTF-8'); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <input type="hidden" name="id" value="<?= $id; ?>">
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center"> <button type="submit" class="btn btn-info">Mettre à jour</button>
            </div>
        </div>
    </div>
</form>