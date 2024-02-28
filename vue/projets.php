<?php
require '../src/classes/Project.php';
$project = new Project();

foreach ($project->getAllByOrder($lang, $lang) as $indice => $project) {
    if ($indice % 2 == 0) {
?>
        <section class="container-fluid min-vh-100">
            <div class="white-block mt-4">
                <h2 class="title my-auto"><?= $project['project_name'] ?></h2>
            </div>
            <div class="row">
                <div class="col-md-6 project-poster">
                    <img class="img-fluid my-auto" src="<?= $project['image'] ?>" alt="<?= $project['project_name'] ?>">
                </div>
                <div class="col-md-6 my-auto d-flex">
                    <div class="project-text my-auto">
                        <?= $project['project_info'] ?>
                    </div>
                    <div class="project-type my-auto"><?= $project['project_type'] ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-white text-uppercase">
                    <?php
                    $dateTime = new DateTime($project['project_date']);
                    $currentLang = $_GET['lang'] ?? '';
                    if ($currentLang == 'fr') {
                        $locale = 'fr_FR';
                    } else {
                        $locale = 'en_US';
                    }
                    $formatter = new IntlDateFormatter(
                        $locale,
                        IntlDateFormatter::LONG,
                        IntlDateFormatter::NONE,
                        new DateTimeZone('UTC'),
                        IntlDateFormatter::GREGORIAN,
                        'MMMM yyyy'
                    );
                    $formattedDate = $formatter->format($dateTime);
                    ?>
                    <h3 class="project-date"><?= $formattedDate ?></h3>

                </div>
            </div>
        </section>
    <?php
    } else {
    ?>
        <section class="container-fluid min-vh-100 bg-white">
            <div class="black-block mt-4">
                <h2 class="text-black text-center my-auto"><?= $project['project_name'] ?></h2>
            </div>
            <div class="row">
                <div class="col-md-6 order-md-2 project-poster">
                    <img class="img-fluid my-auto" src="<?= $project['image'] ?>" alt="<?= $project['project_name'] ?>">
                </div>
                <div class="col-md-6 order-md-1 my-auto d-flex">
                    <div class="project-type my-auto text-black ms-2"><?= $project['project_type'] ?></div>
                    <div class="project-text text-black my-auto">
                        <?= $project['project_info'] ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-black text-uppercase">
                    <?php
                    $dateTime = new DateTime($project['project_date']);
                    $currentLang = $_GET['lang'] ?? '';
                    if ($currentLang == 'fr') {
                        $locale = 'fr_FR';
                    } else {
                        $locale = 'en_US';
                    }
                    $formatter = new IntlDateFormatter(
                        $locale,
                        IntlDateFormatter::LONG,
                        IntlDateFormatter::NONE,
                        new DateTimeZone('UTC'),
                        IntlDateFormatter::GREGORIAN,
                        'MMMM yyyy'
                    );
                    $formattedDate = $formatter->format($dateTime);
                    ?>
                    <h3 class="project-date"><?= $formattedDate ?></h3>
                </div>
            </div>
        </section>
<?php

    }
}
?>