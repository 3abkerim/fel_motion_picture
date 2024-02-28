<nav class="navbar bg-light">
  <div class="container-fluid conFluid">
    <button class="navbar-toggler d-lg-none titreBO" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand titreBO" href="#"><img src="../public/assets/images/logo/FEL_logo-modified_black.png" alt=""></a>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <?php include 'side_navbar.php'; ?>
      </div>
    </div>
  </div>
</nav>