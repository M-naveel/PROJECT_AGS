<<?php 
$pageTitle ="Battery Form";
$pagename ="Battery Form";

include __DIR__ . "/../Class/BLLayer/AuthCheck.php";
include __DIR__ . "/../Navbar.php";
?>



    
<div class="container  Adjust_screen">
  <form action="Record.php" method="post" id="Record_Form">
        <h1 class="mt-5">Battery Form</h1>
        <div class="row">
        <div class="col-6">
          <div class="mb-3">
          <label for="Model_Name" class="form-label">Model_Name*</label>
          <input
            type="text"
            class="form-control"
            id="Model_Name"
             pattern="^^[A-Za-z]+(?:-[A-Za-z]+)?\s\d{2,4}$"
            name="Model_Name"
            placeholder="e.g. DC 150 or SP-Tall 2000"  required/>
          </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
          <label for="Warranty_No" class="form-label"
            >Warranty_No*</label
          >
          <input
            type="text"
            placeholder="e.g. AB12CD34EF56"
            class="form-control"
            id="Warranty_No"
             pattern="^[A-Za-z0-9]{12}$"
            name="Warranty_No"
            placeholder="Warranty_No"
            required
          />
        </div>
      
        </div>
        </div>
  
  <div class="row">
  
 <div class="col-6">
          <div class="mb-3">
            <label for="Battery_Code" class="form-label">Battery_Code*</label>
            <input 
            type="text"
            class="form-control"
            id="Battery_Code"
            name="Battery_Code"
            pattern="^[A-Z0-9]{3,10}$" 
 placeholder="e.g. DC150 or SP2000"
            placeholder="Battery_Code" required/>
          
          </div>
        </div>
  </div>
  <div class="row">

    <div class="col-6">
      <div class="mb-3">
            <label for="Status" class="form-label">Status</label>
            <select class="form-select" id="Status" name="Status">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
        </div>
    </div>
  </div>
 
    <div class="col-6 mt-3">
      <button type="submit" class="btn btn-primary mt-3">Submit</button>
 <input type="button" class="btn  btn-lg btn-primary" name="cancel" value="Cancel" onclick="window.location.href=`/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Index.php`;" />
  
    </div>
  </div>

                     

  </form>
</div>
<?php include "../Footer.php"?>

  