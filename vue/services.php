<?php
require '../src/classes/Service.php';
$services = new Service();

?>
<section class="container mt-4">
    <div class="d-flex flex-wrap">
        <?php
        foreach ($services->getAllByOrder($lang) as $service) {
        ?>
            <h3 id="tab-<?= $service['id_service']; ?>" class="service-name"><?= $service['titre_service']; ?></h3>
        <?php
        }
        ?>
    </div>
    <div class="line"></div>
</section>
<?php
foreach ($services->getAllByOrder($lang) as $service) {
?>
    <section class="container service-content" id="content-<?= $service['id_service']; ?>">
        <div class="white-block mt-5">
            <h2 class="title my-auto"><?= $service['titre_service']; ?></h2>
        </div>
        <article>
            <?= $service['info_service']; ?>
        </article>
    </section>
<?php } ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let tabs = document.querySelectorAll('.service-name');

        function hideAllContents() {
            document.querySelectorAll('.service-content').forEach(function(content) {
                content.style.display = 'none';
            });
        }

        function deactivateAllTabs() {
            tabs.forEach(function(tab) {
                tab.classList.remove('active');
            });
        }

        tabs.forEach(function(tab) {
            tab.addEventListener('click', function() {
                hideAllContents();
                deactivateAllTabs();

                tab.classList.add('active');

                let contentId = 'content-' + tab.id.split('-')[1];
                document.getElementById(contentId).style.display = 'block';
            });
        });

        // hideAllContents();

        if (tabs.length > 0) {
            tabs[0].click();
        }
    });
</script>