<!-- Alert placeholder -->
<div class="alert-placeholder">
    <?php if (isset($_SESSION['success-delete-categ'])) : ?>
        <div class="alert alert-info mt-3">
            <?= htmlspecialchars($_SESSION['success-delete-categ']); ?>
            <?php unset($_SESSION['success-delete-categ']); ?>
        </div>
    <?php elseif (isset($_SESSION['fail-delete-categ'])) : ?>
        <div class="alert alert-warning mt-3">
            <?= htmlspecialchars($_SESSION['fail-delete-categ']); ?>
            <?php unset($_SESSION['fail-delete-categ']); ?>
        </div>
    <?php else : ?>
        <div class="alert mt-3 invisible">Placeholder</div>
    <?php endif; ?>
</div>
<!-- Alert placeholder -->

<div class="row">
    <div class="col-md-12 tableau bg-light mx-auto">
        <table id="articles-table" class="table table-hover bg-light mt-2">
            <thead class="titreTable bg-light text-center">
                <tr class="">
                    <th>#</th>
                    <th>Catégorie</th>
                    <th>Action</th>
                </tr>
                <?php
                $categories = $categorie->getAll();
                foreach ($categories as $indice => $cat) {
                    $indice++
                ?>
                    <tr>
                        <td><?= $indice; ?></td>
                        <td><?= $cat['project_type']; ?></td>
                        <td>
                            <a class="p-2" href="<?= ADMIN_INDEX_URL ?>?page=4&section=3&id=<?= $cat['id_project_type']; ?>"><img class="btns" src="<?= ADMIN_ASSETS_URL ?>/images/edit.png" alt="edit" /></a>
                            <div class="supprimer">
                                <div class="dump2" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $cat['id_project_type']; ?>"> <img src="<?= ADMIN_ASSETS_URL ?>/images/dump.png" alt="delete"> </div>
                            </div>
                        </td>
                    </tr>
                    <div class="modal fade" id="deleteModal<?= $cat['id_project_type']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Êtes-vous sûr de vouloir supprimer catégorie " <?= $cat['project_type']; ?> " ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">non</button>
                                    <a class="btn btn-info" href="<?= ADMIN_CONTROLLERS_URL ?>/categorie/traitement_supprimer_categ.php?id=<?= $cat['id_project_type']; ?>&page=4">oui</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </thead>

            <tbody>
            </tbody>

        </table>
    </div>
</div>