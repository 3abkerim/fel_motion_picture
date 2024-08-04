<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$image = $project->getImage($id);
?>

<!-- Alert placeholder -->
<div class="alert-placeholder">
    <?php if (isset($_SESSION['success-edit-img'])) : ?>
        <div class="alert alert-info mt-3">
            <?= htmlspecialchars($_SESSION['success-edit-img']); ?>
            <?php unset($_SESSION['success-edit-img']); ?>
        </div>
    <?php elseif (isset($_SESSION['error-upload'])) : ?>
        <div class="alert alert-warning mt-3">
            <?= htmlspecialchars($_SESSION['error-upload']); ?>
            <?php unset($_SESSION['error-upload']); ?>
        </div>
    <?php elseif (isset($_SESSION['success_delete_img'])) : ?>
        <div class="alert alert-warning mt-3">
            <?= htmlspecialchars($_SESSION['success_delete_img']); ?>
            <?php unset($_SESSION['success_delete_img']); ?>
        </div>
    <?php else : ?>
        <div class="alert mt-3 invisible">Placeholder</div>
    <?php endif; ?>
</div>
<!-- Alert placeholder -->


<div class="text-center">
    <form method="post" action="../controlleur/project/traitement_img_projet.php" enctype="multipart/form-data" class="mt-5">
        <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-lg-2 col-form-label">Ajouter des images</label>
            <div class="col-lg-4">
                <input type="file" class="form-control mb-1" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="photo" />
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <div class="col-lg-2">
                <button class="btn btn-info" type="submit">Ajouter</button>
            </div>
        </div>
    </form>
</div>


<hr>


<div class="row mt-3">
    <div class="col-lg-4 col-sm-12 text-center mb-3 mx-auto">
        <?php
        if (is_array($image) && !empty($image['image'])) {
            $uploadDir = '../../public/assets/images/uploads/';
            $absoluteImagePath = $uploadDir . $image['image'];

            if (file_exists($absoluteImagePath)) {
        ?>
                <img class="img-fluid img-edit" src="<?php echo $absoluteImagePath; ?>" alt="" />
                <div class="d-flex justify-content-center mt-2 col-lg-12">
                    <a href="../controlleur/traitement_delete_img_projet.php?id=<?php echo $id; ?>">
                        <img class="dump" src="../../public/assets/images/dump.png" alt="" />
                    </a>
                </div>
        <?php
            } else {
                echo '<p>Image file not found.</p>';
            }
        } else {
            echo '<p>No image found.</p>';
        }
        ?>
    </div>
</div>