<?php
// $idUser = $_SESSION['idUserAdmin'];
$currentPage = $_GET['page'] ?? '';
?>
<div class="d-flex flex-column ParentSideBar align-items-center align-items-sm-start px-3 pt-2">
  <a href="../public/index.php?page=3" class="border-end-0 d-inline-block text-truncate col-12 navBtn <?php echo $currentPage == '3' ? 'active' : ''; ?>" data-bs-parent="#sidebar">
    <img src="../public/assets/images/home.png" alt="">
    <span>Tableau de bord</span>
  </a>

  <a href="../public/index.php?page=2" class="border-end-0 d-inline-block text-truncate col-12 navBtn <?php echo $currentPage == '2' ? 'active' : ''; ?>" data-bs-parent="#sidebar">
    <img src="../public/assets/images/pawprint.png" alt="" />
    <span>Projets</span>
  </a>
  <a href="../public/index.php?page=4" class=" border-end-0 d-inline-block text-truncate col-12 navBtn <?php echo $currentPage == '4' ? 'active' : ''; ?>" data-bs-parent="#sidebar">
    <img src="../public/assets/images/blog.png" alt="" />
    <span>Messagerie</span>
  </a>
  <a href="../public/index.php?page=5" class=" border-end-0 d-inline-block text-truncate col-12 navBtn <?php echo $currentPage == '5' ? 'active' : ''; ?>" data-bs-parent="#sidebar">
    <img src="../public/assets/images/calendar.png" alt="" />
    <span>Services</span>
  </a>
  <a href="../public/index.php?page=6" class=" border-end-0 d-inline-block text-truncate col-12 navBtn <?php echo $currentPage == '6' ? 'active' : ''; ?>" data-bs-parent="#sidebar">
    <img src="../public/assets/images/newspaper.png" alt="" />
    <span>À propos</span>
  </a>
  <a href="../public/index.php?page=7" class=" border-end-0 d-inline-block text-truncate col-12 navBtn <?php echo $currentPage == '7' ? 'active' : ''; ?>" data-bs-parent="#sidebar">
    <img src="../public/assets/images/store.png" alt="" />
    <span>Page d'accueil</span>
  </a>
  <a href="../public/index.php?page=8" class=" border-end-0 d-inline-block text-truncate col-12 navBtn <?php echo $currentPage == '8' ? 'active' : ''; ?>" data-bs-parent="#sidebar">
    <img src="../public/assets/images/pet.png" alt="" />
    <span>Admins</span>
  </a>


  <div class="dropup dropposition mb-4 mt-auto testUser">
    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
      <?php //if ($user['fichier'] == NULL) { 
      ?>
      <img class="rounded-circle" alt="hugenerd" width="30" height="30" src="../public/assets/images/user.png" alt="" />
      <?php //} else { 
      ?>
      <!-- <img src="" alt="hugenerd" width="30" height="30" class="rounded-circle" /> -->
      <?php //} 
      ?>
      <span class="d-none d-sm-inline mx-1">Fady WASSEF</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
      <!-- <li><a class="dropdown-item" href="#">Mon compte</a></li> -->
      <!-- <li>
        <hr class="dropdown-divider" />
      </li> -->
      <li><a class="dropdown-item text-white" href="../controller/traitement_deconnexion.php">Déconnexion</a></li>
    </ul>
  </div>
</div>