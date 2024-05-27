<!-- Alert placeholder -->
<div class="alert-placeholder">
    <?php if (isset($_SESSION['success-delete-service'])) : ?>
        <div class="alert alert-info mt-3">
            <?= htmlspecialchars($_SESSION['success-delete-service']); ?>
            <?php unset($_SESSION['success-delete-service']); ?>
        </div>
    <?php elseif (isset($_SESSION['fail-delete-service'])) : ?>
        <div class="alert alert-warning mt-3">
            <?= htmlspecialchars($_SESSION['fail-delete-service']); ?>
            <?php unset($_SESSION['fail-delete-service']); ?>
        </div>
    <?php else : ?>
        <div class="alert mt-3 invisible">Placeholder</div>
    <?php endif; ?>
</div>
<!-- Alert placeholder -->

<div class="row">
    <div class="col-md-12 tableau bg-light mx-auto">
        <table id="service-table" class="table table-hover bg-light mt-2 draggable-table" data-table="service">
            <thead class="titreTable bg-light text-center">
                <tr class="">
                    <th></th>
                    <th>#</th>
                    <th>Service</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $services = $service->getAllByOrderND(fr);
                foreach ($services as $indice => $ser) {
                    $indice++
                ?>
                    <tr class="draggable" data-id="<?= $ser['id_service']; ?>" draggable="true">
                        <td><img class='btns dragBtns' src="../public/assets/images/drag.png" alt="drag button"></td>
                        <td><?= $indice; ?></td>
                        <td><?= $ser['titre_service']; ?></td>
                        <td>
                            <a class="p-2" href="../public/index.php?page=5&section=3&id=<?= $ser['id_service']; ?>"><img class="btns" src="../public/assets/images/edit.png" alt="edit" /></a>
                            <div class="supprimer">
                                <div class="dump2" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $ser['id_service']; ?>"> <img src="../public/assets/images/dump.png" alt="delete"> </div>
                            </div>
                        </td>
                    </tr>
                    <div class="modal fade" id="deleteModal<?= $ser['id_service']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Êtes-vous sûr de vouloir supprimer " <?= $ser['titre_service']; ?> " ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">non</button>
                                    <a class="btn btn-info" href="../controlleur/traitement_supprimer_service.php?id=<?= $ser['id_service']; ?>">oui</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>