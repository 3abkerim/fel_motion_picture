<div class="row">
    <div class="col-12 d-flex justify-content-center">
        <?php if (isset($_SESSION['success_5'])) : ?>
            <div class="alert alert-success mt-3 mx-auto">
                <?= $_SESSION['success_5'] ?>
            </div>
            <?php unset($_SESSION['success_5']);  ?>
        <?php endif; ?>
    </div>
    <div class="col-md-12 tableau mt-3 bg-light mx-auto">
        <table id="articles-table" class="table table-hover bg-light mt-2">
            <thead class="titreTable bg-light text-center">
                <tr class="">
                    <th>#</th>
                    <th>Titre</th>
                    <th>Action</th>
                    <th>Image</th>
                    <th>En ligne</th>
                </tr>
                <tr>
                    <td>Indice</td>
                    <td>Titre</td>
                    <td>
                        <a class="p-2" href="../public/index.php?page=4&section=3&id=<?php //echo $['id_article'];
                                                                                        ?>"><img class="btns" src="../public/assets/images/edit.png" alt="edit" /></a>
                        <div class="supprimer">
                            <div class="dump2" data-bs-toggle="modal" data-bs-target="#deleteModal<?php //echo $article['id_article']; 
                                                                                                    ?>"> <img src="../public/assets/images/dump.png" alt="delete"> </div>
                            <div class="modal fade" id="deleteModal<?php echo $article['id_article']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Êtes-vous sûr de vouloir supprimer l'article <?php //echo $article['id_article']; 
                                                                                            ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btnModal2" data-bs-dismiss="modal">non</button>
                                            <a class="p-2 btnModal" href="../controller/traitement_supprimer_article.php?id=<?php //echo $article['id_article']; 
                                                                                                                            ?>">oui</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a class="p-2" href="../public/index.php?page=4&section=4&id=<?php //echo $article['id_article']; 
                                                                                        ?>"><img class="btns" src="../public/assets/images/image.png" alt="" /></a>
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center">
                            <div class="form-check form-switch mx-auto">
                                <input class="form-check-input" data-type="article" type="checkbox" role="switch" id="flexSwitchCheckDefault_<?php //echo $article['id_article']; 
                                                                                                                                                ?>" data-id-article="<?php //echo $article['id_article']; 
                                                                                                                                                                        ?>" <?php //echo $article['en_ligne'] == 1 ? 'checked' : ''; 
                                                                                                                                                                            ?>>
                            </div>
                        </div>
                    </td>
                </tr>
            </thead>

            <tbody>
            </tbody>

        </table>
    </div>
</div>