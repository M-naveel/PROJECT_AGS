
<div class="row">
<nav class="navbar navbar-expand-lg navbar-light bg-dark text-white px-3 fixed-top">
  <a class="navbar-brand text-white" href="#"><?php echo $pagename ?? "System" ?></a>
  <div class="ms-auto">
    <a href="#" id="Notificationbell" class="text-white me-3 position-relative">
    <i class="fa-regular fa-bell fs-4"></i>
    <?php if (!empty($alerts)) : ?>
        <span class="position-absolute top-0 start-100 translate-middle badge text-white rounded-pill bg-danger">
            <?= count($alerts) ?>
        </span>
    <?php endif; ?>
</a>




     <?php $username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest';
?>
<div class="dropdown d-inline">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa-solid fa-circle-user"></i> 
        <?php echo $username; ?> <!-- Show username here -->
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a href="/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/logout.php" class="dropdown-item me-3">Logout</a>
    </div>
</div>

  </div>
</nav>
</div>

<div class="row mt-5">
     <?php include "Sidebar.php"; ?></div>
     <script src="/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Js/popper.min.js" ></script>
  
      <script src="/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Js/myjs.js"></script>




  