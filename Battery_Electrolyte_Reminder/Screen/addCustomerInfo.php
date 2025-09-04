<?php 
$pageTitle ="Add Customer";
$pagename ="Add Customer Info";
include __DIR__ . "/../Class/BLLayer/authcheck.php"; 
include __DIR__ . "/../Class/DataAccessLayer/customerDAL.php";
include __DIR__ . "/../Class/DataAccessLayer/batteryDAL.php";
include __DIR__ . "/../navbar.php";

// Fetch all active + not deleted batteries
$batteryDAL = new BatteryDAL();
$batteries = $batteryDAL->getActiveBatteries();
?>

<div class="container Adjust_screen my-5">
  <div class="card shadow-lg border-0 rounded-4">
    <div class="card-header custom-header text-white text-center">
      <h2 class="mb-0"><?= $pagename ?></h2>
    </div>
    <div class="card-body p-4">
      <form action="../Class/BLLayer/customerInsertHandler.php" method="POST" id="myForm">

        <!-- Row 1: Customer + Phone -->
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="Customer_Name" class="form-label">Customer Name <span class="text-danger">*</span></label>
            <input type="text" 
                   class="form-control" 
                   id="Customer_Name" 
                   name="Customer_Name" 
                   placeholder="Enter customer name"
                   pattern="^[A-Za-z\s'-]{2,50}$" 
                   required>
          </div>

          <div class="col-md-6 mb-3">
            <label for="Phone_Number" class="form-label">Phone Number <span class="text-danger">*</span></label>
            <input type="text" 
                   class="form-control" 
                   id="Phone_Number" 
                   name="Phone_Number" 
                   placeholder="e.g. 03XX-XXXXXXX" 
                   pattern="^(?:\+92|92|0)3[0-9]{2}-?[0-9]{7}$" 
                   required>
          </div>
        </div>

        <!-- Row 2: Email + Battery -->
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="Email" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" 
                   class="form-control" 
                   id="Email" 
                   name="Email" 
                   placeholder="Enter email address" 
                   required>
          </div>

          <div class="col-md-6 mb-3">
            <label for="Battery_ID" class="form-label">Select Battery <span class="text-danger">*</span></label>
            <select class="form-select" id="Battery_ID" name="Battery_ID" required>
              <option value="">-- Select Battery --</option>
              <?php for ($i = 0; $i < count($batteries); $i++): ?>
                <option value="<?= htmlspecialchars($batteries[$i]['Id']); ?>">
                  <?= htmlspecialchars($batteries[$i]['Model_Name']); ?>
                </option>
              <?php endfor; ?>
            </select>
          </div>
        </div>

        <!-- Row 3: Sale Date -->
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="Sale_Date" class="form-label">Sale Date <span class="text-danger">*</span></label>
            <input type="datetime-local" 
                   class="form-control" 
                   id="Sale_Date" 
                   name="Sale_Date" 
                   required>
          </div>
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-end gap-2 mt-4">
          <button type="submit" class="btn btn-success px-4">Submit</button>
          <button type="button" class="btn btn-secondary px-4"
                  onclick="window.location.href='/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Index.php';">
            Cancel
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include "../footer.php" ?>
<script src="/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Js/myjs.js"></script>
