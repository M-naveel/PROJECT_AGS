<?php 
$pageTitle ="Battery Form";
$pagename ="Battery Form";

include __DIR__ . "/../Class/BLLayer/authcheck.php";
include __DIR__ . "/../navbar.php";
?>

<div class="container  my-5 Adjust_screen">
  <div class="card  shadow-lg border-0">
    <div class="card-header custom-header  text-white">
      <h3 class="mb-0 ">
        <i class="bi  bi-battery-charging me-2"></i> Add New Battery
      </h3>
    </div>
    <div class="card-body">
      <form action="../Class/BLLayer/batteryInsertHandler.php" method="POST" id="Record_Form">
        
        <!-- Model & Warranty -->
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="Model_Name" class="form-label fw-bold">Battery Model *</label>
            <input
              type="text"
              class="form-control"
              id="Model_Name"
              name="Model_Name"
              pattern="^^[A-Za-z]+(?:-[A-Za-z]+)?\s\d{2,4}$"
              placeholder="e.g. DC 150 or SP-Tall 2000"
              required
            />
            <div class="form-text text-muted">
              Format: Letters with optional dash + space + 2–4 digit number
            </div>
          </div>
          
          <div class="col-md-6 mb-3">
            <label for="Warranty_No" class="form-label fw-bold">Warranty No *</label>
            <input
              type="text"
              class="form-control"
              id="Warranty_No"
              name="Warranty_No"
              pattern="^[A-Za-z0-9]{12}$"
              placeholder="e.g. AB12CD34EF56"
              required
            />
            <div class="form-text text-muted">
              Must be exactly 12 alphanumeric characters
            </div>
          </div>
        </div>

        <!-- Status & Battery Code -->
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="Status" class="form-label fw-bold">Status</label>
            <select class="form-select" id="Status" name="Status">
              <option value="active">✅ Active</option>
              <option value="inactive">❌ Inactive</option>
            </select>
          </div>

          <div class="col-md-6 mb-3">
            <label for="Battery_Code" class="form-label fw-bold">Battery Code *</label>
            <input 
              type="text"
              class="form-control"
              id="Battery_Code"
              name="Battery_Code"
              pattern="^[A-Z0-9]{3,10}$"
              placeholder="e.g. DC150 or SP2000"
              required
            />
            <div class="form-text text-muted">
              3–10 uppercase letters or numbers only
            </div>
          </div>
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-end gap-2 mt-4">
          <button type="submit" class="btn btn-success px-4">
            <i class="bi bi-check-circle me-1"></i> Submit
          </button>
          <button type="button" class="btn btn-outline-secondary px-4" 
                  onclick="window.location.href='/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Index.php';">
            <i class="bi bi-x-circle me-1"></i> Cancel
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include "../footer.php"?>
