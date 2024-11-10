<?php
$images = $sponsor->getAllNotDeleted();
?>

<div class="text-center">
    <form method="post" action="<?= ADMIN_CONTROLLERS_URL ?>/homepage/homepageSponsorImageAddController.php" enctype="multipart/form-data" class="mt-5">
        <div class="row mb-3">
            <div class="col-md-6 mb-2">
                <label for="inputGroupFile04" class="form-label">Ajouter une image</label>
                <input
                    type="file"
                    class="form-control"
                    id="inputGroupFile04"
                    name="photo"
                    required
                />
            </div>

            <div class="col-md-4 mb-2">
                <label for="textInput" class="form-label">Libellé client/partenaire</label>
                <input
                    type="text"
                    class="form-control"
                    id="textInput"
                    name="description"
                    aria-label="Description"
                    required
                />
            </div>

            <div class="col-md-2 d-flex align-items-end mb-2">
                <button class="btn btn-primary w-100" type="submit">Ajouter</button>
            </div>
        </div>
    </form>
</div>

<div class="row linePhotos"></div>

<!-- Alert placeholder -->
<div class="alert-placeholder">
    <?php if (isset($_SESSION['success'])) : ?>
        <div class="alert alert-info mt-3">
            <?= htmlspecialchars($_SESSION['success']); ?>
            <?php unset($_SESSION['success']); ?>
        </div>
    <?php elseif (isset($_SESSION['fail'])) : ?>
        <div class="alert alert-warning mt-3">
            <?= htmlspecialchars($_SESSION['fail']); ?>
            <?php unset($_SESSION['fail']); ?>
        </div>
    <?php else : ?>
        <div class="alert mt-3 invisible">Placeholder</div>
    <?php endif; ?>
</div>
<!-- Alert placeholder -->

<div class="row mt-3" id="imageContainer">
    <?php foreach ($images as $indice => $image){
        ?>
        <div class="col-lg-4 col-sm-12 text-center mb-3">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-fluid imgHeight" src="<?= IMAGES_URL.$image['image']; ?>" alt=""/>
                </div>
                <div class="d-flex justify-content-center col-lg-12">
                    <a href="<?= ADMIN_CONTROLLERS_URL ?>/homepage/homepageSponsorDeleteImageController.php?idPhoto=<?= $image['id_sponsor']; ?>">
                        <i class="fa-solid fa-trash text-danger"></i>
                    </a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>