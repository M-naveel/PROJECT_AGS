<<?php 
$pageTitle ="Battery Form";
$pagename ="Battery Form";

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
            name="Model_Name"
            placeholder="Model_Name" required/>
          </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
          <label for="Warranty_No" class="form-label"
            >Warranty_No*</label
          >
          <input
            type="text"
            class="form-control"
            id="Warranty_No"
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
          <label for="Updated_By" class="form-label"
            >Updated_By</label
          >
          <input
            type="text"
            class="form-control"
            id="Updated_By"
            name="Updated_By"
            placeholder="Updated_By"
          required/>
          
        </div>
  </div>
 <div class="col-6">
          <div class="mb-3">
            <label for="Battery_Code" class="form-label">Battery_Code*</label>
            <input 
            type="text"
            class="form-control"
            id="Battery_Code"
            name="Battery_Code"
            placeholder="Battery_Code" required/>
          
          </div>
        </div>
  </div>
  <div class="row">
      <div class="col-6">
        <div class="mb-3">
          <label for="Updated_At" class="form-label"
            >Updated_At</label
          >
          <input
            type="datetime-local"
            class="form-control"
            id="Updated_At"
            name="Updated_At"
            
          />
          
        </div>

      </div>
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
  <div class="row">
    <div class="col-6">
      <div class="mb-3">
          <label for="Sale_Date" class="form-label">Sale Date</label>
          <input

            type="datetime-local"
            class="form-control"
            id="Updated_At"
            name="Sale_Date"
            
          />
          
      </div>
    </div>
    <div class="col-6 mt-3">
      <button type="submit" class="btn btn-primary mt-3">Submit</button>
<<<<<<< Updated upstream
  <button type="button" class="btn   btn-Secondary mt-3"  onclick="window.location.href=`/Battery_Electrolyte_Reminder/Index.php`;"  >Clear</button>
=======
  <button type="button" class="btn   btn-Secondary mt-3"  onclick="window.location.href=`/GitHub/PROJECT_AGS/PROJECT_AGS/Battery_Electrolyte_Reminder/Index.php`;"  >Clear</button>
>>>>>>> Stashed changes
  
    </div>
  </div>

                     

  </form>
</div>
<?php include "../Footer.php"?>

  