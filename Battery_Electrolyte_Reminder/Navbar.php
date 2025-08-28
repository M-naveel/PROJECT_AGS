

<div class="row">
<nav class="navbar navbar-expand-lg navbar-light bg-dark text-white px-3 fixed-top">
  <a class="navbar-brand text-white" href="#"><?php echo $pagename ?? "System" ?></a>
  <div class="ms-auto">
    <a href="#" class="text-white me-3"><i class="fa-regular fa-bell"></i></a>



      <div class="dropdown d-inline">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa-solid fa-circle-user"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="#">LogOut</a>
        </div>
      </div>


  </div>
</nav>
</div>

<div class="row mt-5">
     <?php include "Sidebar.php"; ?></div>
     <script src="/Battery_Electrolyte_Reminder/js/popper.min.js" ></script>




  