<?php
require '../src/classes/Sponsor.php';
$sponsors = new Sponsor();
?>
<section class="container-fluid">
    <video class="video-home" src="../public/assets/videos/EFL_logo_light.mp4" muted autoplay></video>
</section>

<section class="container-fluid">
    <div class="white-block">
        <h2 class="title my-auto"><?= $translations['behind the scenes'] ?></h2>
    </div>
    <div class="d-flex justify-content-end project-img"><img class="img-fluid" src="../public/assets/images/p-4.png" alt=""></div>
    <div class="d-flex justify-content-start project-img mt-4"><img class="img-fluid" src="../public/assets/images/p-2.png" alt=""></div>
    <div class="d-flex justify-content-end project-img mt-4"><img class="img-fluid" src="../public/assets/images/p-1.png" alt=""></div>
</section>

<section class="container-fluid">
    <div class="white-block mt-5">
        <h2 class="title my-auto"><?= $translations['partners and clients'] ?></h2>
    </div>



    <div class="logos">
        <div class="logos-slide">
            <?php
            foreach ($sponsors->getAllNotDeleted() as $sponsor) {
            ?>
                <img src="<?= $sponsor['image']; ?>" alt="<?= $sponsor['sponsor']; ?>">
            <?php
            }
            ?>
        </div>
    </div>

</section>