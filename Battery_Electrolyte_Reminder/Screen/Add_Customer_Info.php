<?php 
$pageTitle ="Add Customer";
$pagename ="Add Customer Info";
include __DIR__ . "/../Navbar.php";
include __DIR__ . "/../Class/DataAccessLayer/GetBatteryName.php";

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
          <input type="text" class="form-control" id="Customer_Name" name="Customer_Name" placeholder="Customer Name" required/>
        </div>
      </div>
      <div class="col-6">
        <div class="mb-3">
          <label for="Phone_Number" class="form-label" required>Phone Number*</label>
          <input type="text" class="form-control" id="Phone_Number" name="Phone_Number" placeholder="Phone Number" required/>
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
        <div class="mb-3">
       <select class="form-select form-control mt-4" name="Battery_ID" aria-label="Battery Model" required>
    <option selected disabled>Open this select menu*</option>
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
          <label for="Updated_By" class="form-label">Updated By</label>
          <input type="text" class="form-control" id="Updated_By" name="Updated_By" placeholder="Updated By" />
        </div>
      </div>
      <div class="col-6">
        <div class="mb-3">
          <label for="Updated_At" class="form-label">Updated At</label>
          <input type="datetime-local" class="form-control" id="Updated_At" name="Updated_At" />
        </div>
      </div>
      
    </div> 
    <div class="row">
      <div class="col-6">
        <div class="mb-3">
          <label for="Sale_Date" class="form-label">Sale Date</label>
          <input type="datetime-local" class="form-control" id="Sale_Date" name="Sale_Date" placeholder="Sale Date" />
        </div>
      </div>
      <div class="col-6 mt-4">
      
        
        <div class="mb-3">
  <label for="Status" class="form-label">Status</label>
  <select class="form-select" id="Status" name="Status">
    <option value="active">Active</option>
    <option value="inactive">Inactive</option>
  </select>
</div>

        </div>
        
      </div>
      <input type="button" class="btn  btn-lg btn-primary" name="cancel" value="Cancel" onclick="window.location.href=`/GitHub/PROJECT_AGS/PROJECT_AGS/Battery_Electrolyte_Reminder/Index.php`;" />
    <button type="submit" class="btn  btn-lg btn-primary  ">Submit</button>

  </form>
</div>


<?php include "../Footer.php"?>

  