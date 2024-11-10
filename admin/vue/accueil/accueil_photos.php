<?php
$images = $homepageImages->getAllByOrderNotDeleted();
?>

<div class="text-center">
    <form method="post" action="<?= ADMIN_CONTROLLERS_URL ?>/homepage/homepageImageAddController.php" enctype="multipart/form-data" class="mt-5">
        <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-lg-2 col-form-label">Ajouter des images</label>
            <div class="col-lg-4 mb-2">
                <input
                    type="file"
                    class="form-control"
                    id="inputGroupFile04"
                    aria-describedby="inputGroupFileAddon04"
                    aria-label="Upload"
                    name="photo[]"
                    multiple
                    required
                />
            </div>
            <div class="col-lg-2">
                <button class="btn btn-primary" type="submit">Ajouter</button>
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
        <div class="col-lg-4 col-sm-12 image-container text-center mb-3 imageItem drop-target" draggable="true" data-image='<?= $image['id_image']; ?>'>
            <div class="row">
                <div class="col-lg-12 img-wrapper">
                    <span class="number"><?= $indice+1; ?></span>
                    <img class="img-fluid imgHeight" src="<?= IMAGES_URL.$image['image']; ?>" alt=""/>
                </div>
                <div class="d-flex justify-content-center col-lg-12">
                    <a href="<?= ADMIN_CONTROLLERS_URL ?>/homepage/homepageImageDeleteController.php?idPhoto=<?= $image['id_image']; ?>">
                        <i class="fa-solid fa-trash text-danger"></i>
                    </a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<div id="truc">

</div>