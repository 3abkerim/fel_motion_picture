<form action="../controlleur/traitement_ajout_projet.php" method="post">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Project Name *</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="enName" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Content *</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="enContent" required></textarea>
                </div>

            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nom du projet *</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="frName" placeholder="" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Contenu *</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="frContent" required></textarea>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Date du projet *</label>
                    <input type="date" class="form-control" id="exampleFormControlInput1" name="date" placeholder="" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Catégorie *</label>
                    <select class="form-select" aria-label="Default select example" name="categ" required>
                        <option selected disabled>Choisissez une catégorie</option>
                        <?php foreach ($categorie->getAll() as $cat) { ?>
                            <option value="<?= $cat['id_project_type']; ?>"><?= $cat['project_type']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center"> <button type="submit" class="btn btn-info">Ajouter</button>
            </div>
        </div>
    </div>
</form>