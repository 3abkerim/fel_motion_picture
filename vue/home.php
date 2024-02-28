<?php
require '../src/classes/Sponsor.php';
require '../src/classes/HomeImages.php';
require '../src/classes/About.php';


$sponsors = new Sponsor();
$HomeImages = new HomeImages();
$about = new About();

?>
<section class="container-fluid">
    <video class="video-home" src="../public/assets/videos/EFL_logo_light.mp4" muted autoplay playsinline>
        <source src="../public/assets/videos/EFL_logo_light.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</section>
<section class="container-fluid">
    <div class="white-block">
        <h1 class="h2 title my-auto"><?= $translations['qsn']; ?></h1>
    </div>
    <div class="container-sm mb-5">
        <h3 class="text-white text-center">
            <?= $about->getqsn($lang); ?>
        </h3>
    </div>
</section>
<section class="container-fluid">
    <div class="white-block">
        <h2 class="title my-auto"><?= $translations['behind the scenes'] ?></h2>
    </div>
    <?php
    foreach ($HomeImages->getAllByOrderNotDeleted() as $indice => $homeimg) {
        if ($indice % 2 == 0) {
    ?>
            <div class="d-flex justify-content-end project-img mt-4" data-aos="fade-left"><img class="img-fluid" src="<?= $homeimg['image']; ?>" alt="behind the scenes image"></div>
        <?php
        } else {
        ?>
            <div class="d-flex justify-content-start project-img mt-4 fade-left" data-aos="fade-right"><img class="img-fluid" src="<?= $homeimg['image']; ?>" alt="behind the scenes image"></div>
        <?php
        }
        ?>
    <?php } ?>
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