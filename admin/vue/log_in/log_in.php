<?php
$page = 2;
$header = sprintf('Location: %s?page=%s', ADMIN_PUBLIC_URL, $page);
if (isset($_SESSION['idUserAdmin'])){
    header($header);
}

?>
<div class="mt-5 p-5 mx-auto ">
    <div class="logo text-center mb-4">
        <img src="<?= ADMIN_ASSETS_URL; ?>/images/logo/FEL_logo.png" alt="">
    </div>

    <?php if (isset($_SESSION['error_login'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error_login'] ?>
        </div>
        <?php unset($_SESSION['error_login']); ?>
    <?php elseif (isset($_SESSION['success_signUp'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success_signUp'] ?>
        </div>
        <?php unset($_SESSION['success_signUp']); ?>
    <?php endif; ?>

    <form class="formBO" method="post" action="<?= ADMIN_CONTROLLERS_URL ?>/log_in/loginController.php">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label text-white">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Votre email" name="email">
            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label text-white">Mot de passe</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Votre mot de passe" name="mdp">
        </div>
        <!-- <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Se souvenir de moi</label>
        </div> -->
        <div class="text-center mt-5">
            <button  type="submit" class="btn btn-info">Connexion</button>
        </div>
    </form>
</div>

