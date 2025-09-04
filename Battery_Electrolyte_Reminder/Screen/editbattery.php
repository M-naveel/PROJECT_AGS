<?php
$pagename ="Battery Edit Form";
include __DIR__ . "/../Class/BLLayer/authcheck.php";
include __DIR__ . "/../Class/BLLayer/batteryHandler.php";
include __DIR__ . "/../navbar.php";
?>

<div class="container my-5 Adjust_Screen">
  <div class="card shadow-lg border-0">
    <div class="card-header custom-header text-white">
      <h3 class="mb-0"><i class="bi bi-battery-charging me-2"></i> <?= $pagename ?? "System" ?></h3>
    </div>
    <div class="card-body">
      <form method="POST" class="needs-validation" novalidate>
        
        <!-- Model Name -->
        <div class="mb-3">
          <label for="Model_Name" class="form-label fw-bold">Model Name</label>
          <input type="text" 
                 id="Model_Name" 
                 name="Model_Name" 
                 class="form-control" 
                 placeholder="e.g. DC 150 or SP-Tall 2000"
                 pattern="^^[A-Za-z]+(?:-[A-Za-z]+)?\s\d{2,4}$"
                 value="<?= htmlspecialchars($battery['Model_Name']); ?>" 
                 required>
          <div class="form-text">Format: Letters + optional hyphen + space + 2–4 digits.</div>
        </div>

        <!-- Warranty Number -->
        <div class="mb-3">
          <label for="Warranty_No" class="form-label fw-bold">Warranty No</label>
          <input type="text" 
                 id="Warranty_No" 
                 name="Warranty_No" 
                 class="form-control" 
                 placeholder="e.g. AB12CD34EF56"
                 pattern="^[A-Za-z0-9]{12}$"
                 value="<?= htmlspecialchars($battery['Warranty_No']); ?>" 
                 required>
          <div class="form-text">Must be exactly 12 alphanumeric characters.</div>
        </div>

        <!-- Battery Code -->
        <div class="mb-3">
          <label for="Battery_Code" class="form-label fw-bold">Battery Code</label>
          <input type="text" 
                 id="Battery_Code" 
                 name="Battery_Code" 
                 class="form-control"
                 placeholder="e.g. DC150 or SP2000"
                 pattern="^[A-Z0-9]{3,10}$"
                 value="<?= htmlspecialchars($battery['Battery_Code']); ?>" 
                 required>
          <div class="form-text">3–10 characters (uppercase letters and numbers only).</div>
        </div>

        <!-- Status -->
        <div class="mb-3">
          <label for="Status" class="form-label fw-bold">Status</label>
          <select id="Status" name="Status" class="form-select">
            <option value="active" <?= $battery['Status'] === 'active' ? 'selected' : ''; ?>>Active</option>
            <option value="inactive" <?= $battery['Status'] === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
          </select>
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-between">
          <a href="record.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle"></i> Cancel
          </a>
          <button type="submit" class="btn btn-success">
            <i class="bi bi-save"></i> Update
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include __DIR__ . "/../footer.php"; ?>
