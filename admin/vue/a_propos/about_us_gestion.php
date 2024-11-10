<!-- Alert placeholder -->
<div class="alert-placeholder">
    <?php if (isset($_SESSION['success-delete'])) : ?>
        <div class="alert alert-info mt-3">
            <?= htmlspecialchars($_SESSION['success-delete']); ?>
            <?php unset($_SESSION['success-delete']); ?>
        </div>
    <?php elseif (isset($_SESSION['fail-delete'])) : ?>
        <div class="alert alert-warning mt-3">
            <?= htmlspecialchars($_SESSION['fail-delete']); ?>
            <?php unset($_SESSION['fail-delete']); ?>
        </div>
    <?php else : ?>
        <div class="alert mt-3 invisible">Placeholder</div>
    <?php endif; ?>
</div>
<!-- Alert placeholder -->

<div class="row">
    <div class="col-md-12 tableau bg-light mx-auto">
        <table id="about_us-table" class="table table-hover bg-light mt-2 draggable-table" data-table="about">
            <thead class="titreTable bg-light text-center">
                <tr>
                    <th></th>
                    <th>#</th>
                    <th>About us text unit</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $abouts = $about->getAllByOrder("fr");
            foreach ($abouts as $indice => $aboutItem) {
                $indice++;
                ?>
                <tr class="draggable" data-id="<?= $aboutItem['id_about_us']; ?>" draggable="true">
                    <td><img class='btns dragBtns' src="<?= ADMIN_ASSETS_URL ?>/images/drag.png" alt="drag button"></td>
                    <td><?= $indice; ?></td>
                    <td><?= $aboutItem['title']; ?></td>
                    <td>
                        <a class="p-2" href="<?= ADMIN_INDEX_URL ?>?page=6&section=3&id=<?= $aboutItem['id_about_us']; ?>"><img class="btns" src="<?= ADMIN_ASSETS_URL ?>/images/edit.png" alt="edit" /></a>
                        <div class="supprimer">
                            <div class="dump2" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $aboutItem['id_about_us']; ?>">
                                <img src="<?= ADMIN_ASSETS_URL ?>/images/dump.png" alt="delete">
                            </div>
                        </div>
                    </td>
                </tr>
                <div class="modal fade" id="deleteModal<?= $aboutItem['id_about_us']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Êtes-vous sûr de vouloir supprimer " <?= $aboutItem['title']; ?> " ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">non</button>
                                <a class="btn btn-info" href="<?= ADMIN_CONTROLLERS_URL ?>/a_propos/aProposDeleteController.php?id=<?= $aboutItem['id_about_us']; ?>">oui</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>