<?php
require '../src/classes/About.php';
require '../src/classes/User.php';
$abouts = new About();
$users = new User();
?>

<section class="container">
    <div class="white-block mt-5">
        <h2 class="title my-auto"><?= $translations['our philosophy']; ?></h2>
    </div>
    <?php
    foreach ($abouts->getAllByOrder($lang) as $about) {
    ?>

        <div class="title-philosophy"><?= $about['title']; ?></div>
        <article>
            <?= $about['about_us']; ?>
        </article>

    <?php
    }
    ?>


    <div class="white-block mt-5">
        <h2 class="title my-auto"><?= $translations['our founders']; ?></h2>
    </div>
    <div class="row">
        <div class="col-md-6 founders">
            <img src="../public/assets/images/elnamrawy.jpeg" class="img-fluid" alt="mohamed-elnamrawy">
            <h2 class="text-white text-uppercase mt-2">mohamed elnamrawy</h2>
            <h4 class="founder-info"><?= $translations['founder']; ?></h4>
        </div>
        <div class="col-md-6 founders">
            <img src="../public/assets/images/fox.jpeg" class="img-fluid" alt="fady-wassef">
            <h2 class="text-white text-uppercase mt-2">fady wassef</h2>
            <h4 class="founder-info"><?= $translations['ceo']; ?></h4>
        </div>
    </div>

    <div class="white-block mt-5">
        <h2 class="title my-auto"><?= $translations['key people']; ?></h2>
    </div>
    <div class="row">
        <?php $keyPeople = $users->getKeyPeople();
        $total = count($keyPeople);
        foreach ($keyPeople as $indice => $user) { ?>
            <div class="<?= $total > 1 ?  'col-md-6' :  'col-12'; ?> founders">
                <img src="<?= $user['image']; ?>" class="img-fluid" alt="<?= $user['prenom'] ?> <?= ' ' ?> <?= $user['nom'] ?>">
                <h2 class="text-white text-uppercase mt-2"><?= $user['prenom'] ?> <?= ' ' ?> <?= $user['nom'] ?></h2>
                <h4 class="founder-info"><?= $user['info_key_people']; ?></h4>
            </div>
        <?php } ?>
    </div>
</section>