<div class="mt-5 p-5 mx-auto ">
    <div class="logo text-center mb-4">
        <img src="<?= ADMIN_ASSETS_URL; ?>/images/logo/FEL_logo.png" alt="">
    </div>

    <form class="formBO" method="post" action="<?= ADMIN_CONTROLLERS_URL ?>/signUpController/signUpController.php">
        <div class="mb-3">
            <label for="exampleInputPrenom" class="form-label text-white">Prénom</label>
            <input type="text" class="form-control" id="exampleInputPrenom" placeholder="Votre prénom" name="prenom" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputNom" class="form-label text-white">Nom</label>
            <input type="text" class="form-control" id="exampleInputNom" placeholder="Votre nom" name="nom" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label text-white">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Votre email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label text-white">Mot de passe</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Votre mot de passe" name="mdp" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputConPassword1" class="form-label text-white">Confirmation mot de passe</label>
            <input type="password" class="form-control" id="exampleInputConPassword1" placeholder="Confirmation mot de passe" name="ConfirmationMdp" required>
        </div>
        <!-- <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Se souvenir de moi</label>
        </div> -->
        <div class="text-center mt-5">
            <button type="submit" class="btn btn-info">S'inscrire</button>
        </div>
    </form>
    <?php if (isset($_SESSION['error_signUp'])): ?>
        <div class="alert alert-danger mt-2">
            <?= $_SESSION['error_signUp'] ?>
        </div>
        <?php unset($_SESSION['error_signUp']);  ?>
    <?php endif; ?>
</div>

