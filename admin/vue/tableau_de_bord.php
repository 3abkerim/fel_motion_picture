<?php

?>
<div class="container navTest">
    <div class="row ">
        <div class="col-12">
            <div class="titreGestion mt-3">
                Tableau de bord
            </div>
        </div>
    </div>
</div>
<div class="container mt-4">
    <div class="row d-flex justify-content-around p-3">
        <div onclick="window.location.href='<?= ADMIN_PUBLIC_URL ?>/index.php?page=2&section=2'" class="col-lg-5 offset-lg-1 bubbles d-flex flex-column justify-content-center align-items-center">
            <div class="numberTB">Projets</div>
            <div class="enLigne">En ligne</div>
        </div>
        <div onclick="window.location.href='<?= ADMIN_PUBLIC_URL ?>/index.php?page=8'" class="col-lg-5 bubbles d-flex flex-column justify-content-center align-items-center">
            <div class="numberTB">3</div>
            <div class="demandesTB text-center">Mails</div>
        </div>
    </div>

</div>