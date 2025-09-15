<?php 
  include __DIR__ . "/header.php";

  
  
  // Get current page name (e.g., batteryForm.php)
  $currentPage = basename($_SERVER['PHP_SELF']);
  ?>
<link rel="stylesheet" href="/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Customize_Css/style.css" />

<!-- Sidebar CSS -->


<!-- Sidebar -->
<div class="sidebar mt-5">
  <div class="menu-section">
    <a href="/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Index.php" 
       class="<?= ($currentPage == 'Index.php') ? 'active' : '' ?>">
      <i class="fa-solid fa-circle me-2"></i> Dashboard
    </a>
  </div>

  <div class="menu-section">
    <hr>
    <ul>
      <li class="menu_style">
        <div class="dropdown">
          <a href="#" class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true">
            Battery
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <a class="dropdown-item <?= ($currentPage == 'batteryForm.php') ? 'active' : '' ?>" 
               href="/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Screen/batteryForm.php">Add Battery Info</a>
            <a class="dropdown-item <?= ($currentPage == 'record.php') ? 'active' : '' ?>" 
               href="/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Screen/record.php">View Records</a>
          </div>
        </div>
      </li>
    </ul>

    <ul>
      <li class="menu_style">
        <div class="dropdown mt-2">
          <a href="#" class="dropdown-toggle" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="true">
            Customer
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
            <a class="dropdown-item <?= ($currentPage == 'addCustomerInfo.php') ? 'active' : '' ?>" 
               href="/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Screen/addCustomerInfo.php">Add Customer Info</a>
            <a class="dropdown-item <?= ($currentPage == 'customerInfoRecord.php') ? 'active' : '' ?>" 
               href="/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Screen/customerInfoRecord.php">Customer Info Record</a>
          </div>

        </div>
      </li>
    </ul>
    <li class="menu_style">
           <?php if($username=="ADMIN"){ ?>
      <a class="dropdown-item <?= ($currentPage == 'emailLogs.php') ? 'active' : '' ?>" 
             href="/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Screen/emailLogs.php">Email Logs</a>
    <?php }?>
            </li>
     
    </li><li class="menu_style">
      <a class="dropdown-item <?= ($currentPage == 'User_Manual.php') ? 'active' : '' ?>" 
             href="/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/UserManual/User_Manual.pdf"target="_blank"
>UserManual</a>
  </div>
</div>
