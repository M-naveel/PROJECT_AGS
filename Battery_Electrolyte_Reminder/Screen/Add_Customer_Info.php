<?php 
$pageTitle ="Add Customer";
$pagename ="Add Customer Info";
include __DIR__ . "/../Class/BLLayer/AuthCheck.php"; 
include __DIR__ . "/../Class/DataAccessLayer/GetBatteryName.php";
include __DIR__ . "/../Navbar.php";


// Fetch all active + not deleted batteries
$BatterySql = "SELECT id, Model_Name 
               FROM battery 
               WHERE Status = 'active' AND is_deleted = 0";
$BatteryResult = $conn->query($BatterySql);

$batteries = [];
while ($row = $BatteryResult->fetch_assoc()) {
    $batteries[] = $row;
}




?>
    <div class="container 
      Adjust_screen" >
      
  <form action="Customer_Info_Record.php" method="POST" id="myForm">
    <h1 class="mt-5">Customer Form</h1>

    <div class="row">
      <div class="col-6">
        <div class="mb-3">
          <label for="Customer_Name" class="form-label" required>Customer Name*</label>
          <input type="text" pattern="^[A-Za-z\s'-]{2,50}$"  class="form-control" id="Customer_Name" name="Customer_Name" placeholder="Customer Name" required/>
        </div>
      </div>
      <div class="col-6">
        <div class="mb-3">
          <label for="Phone_Number" class="form-label" required>Phone Number*</label>
          <input type="text" class="form-control" id="Phone_Number"  pattern="^(?:\+92|92|0)3[0-9]{2}-?[0-9]{7}$" name="Phone_Number" placeholder="Phone Number" required/>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-6">
        <div class="mb-3">
          <label for="Email" class="form-label "required>Email*</label>
          <input type="email" class="form-control" id="Email" name="Email" placeholder="Email" required/>
        </div>
      </div>
      <div class="col-6 mt-2">
        <div class=">
          <label for="Battery_ID" class="form-label "required>Select Battery*</label>
          <select class="form-select form-control " name="Battery_ID" aria-label="Battery Model" required>
          <?php for ($i = 0; $i < count($batteries); $i++): ?>
          <option value="<?= $batteries[$i]['id'] ?>">
          <?= $batteries[$i]['Model_Name'] ?>
          </option>
          <?php endfor; ?>
          </select>
        </div>
      </div>
    </div>

    
    <div class="row">
      <div class="col-6">
        <div class="mb-3">
          <label for="Sale_Date" class="form-label">Sale Date*</label>
          <input type="datetime-local" class="form-control" id="Sale_Date" name="Sale_Date" placeholder="Sale Date" Required/>
        </div>
      </div>

        
      </div>
      <input type="button" class="btn  btn-lg btn-primary" name="cancel" value="Cancel" onclick="window.location.href=`/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Index.php`;" />
    <button type="submit" class="btn  btn-lg btn-primary  ">Submit</button>

  </form>
</div>


<?php include "../Footer.php"?>
<script src="/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Js/myjs.js";></script>

  