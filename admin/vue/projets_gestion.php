<!-- Alert placeholder -->
<div class="alert-placeholder">
    <?php if (isset($_SESSION['success-delete-projet'])) : ?>
        <div class="alert alert-info mt-3">
            <?= htmlspecialchars($_SESSION['success-delete-projet']); ?>
            <?php unset($_SESSION['success-delete-projet']); ?>
        </div>
    <?php elseif (isset($_SESSION['fail-delete-projet'])) : ?>
        <div class="alert alert-warning mt-3">
            <?= htmlspecialchars($_SESSION['fail-delete-projet']); ?>
            <?php unset($_SESSION['fail-delete-projet']); ?>
        </div>
    <?php else : ?>
        <div class="alert mt-3 invisible">Placeholder</div>
    <?php endif; ?>
</div>
<!-- Alert placeholder -->

<div class="row">
    <div class="col-md-12 tableau mt-1 bg-light mx-auto">
        <table id="articles-table" class="table table-hover bg-light mt-2">
            <thead class="titreTable bg-light text-center">
                <tr class="">
                    <th>#</th>
                    <th>Titre</th>
                    <th>Action</th>
                    <th>Image</th>
                    <th>En ligne</th>
                </tr>
                <?php
                $projects = $project->getAllFrench();
                foreach ($projects as $indice => $pro) {
                    $indice++
                ?>
                    <tr>
                        <td><?= $indice; ?></td>
                        <td><?= $pro['project_name']; ?></td>
                        <td>
                            <a class="p-2" href="../public/index.php?page=2&section=3&id=<?= $pro['id_project']; ?>"><img class="btns" src="../public/assets/images/edit.png" alt="edit" /></a>
                            <div class="supprimer">
                                <div class="dump2" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $pro['id_project']; ?>"> <img src="../public/assets/images/dump.png" alt="delete"> </div>
                            </div>
                        </td>
                        <td>
                            <a class="p-2" href="../public/index.php?page=4&section=4&id=<?= $pro['id_project']; ?>"><img class="btns" src="../public/assets/images/image.png" alt="" /></a>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center">
                                <div class="form-check form-switch mx-auto">
                                    <input class="form-check-input" data-type="projet" type="checkbox" role="switch" id="flexSwitchCheckDefault_<?= $pro['id_project']; ?>" data-id-article="<?= $pro['id_project']; ?>" <?= $pro['online'] == 1 ? 'checked' : ''; ?>>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- MODAL -->
                    <div class="modal fade" id="deleteModal<?php echo $pro['id_project']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Êtes-vous sûr de vouloir supprimer <?= $pro['project_name']; ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">non</button>
                                    <a class="btn btn-info" href="../controller/traitement_supprimer_projet.php?id=<?= $pro['id_project']; ?>">oui</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- MODAL -->

                <?php } ?>
            </thead>

            <tbody>
            </tbody>

        </table>
    </div>
</div>