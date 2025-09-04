<?php
$pagename = "Customer_Info";
$Heading  = "Customer Info";

// Only include what's necessary
include __DIR__ . "/../Class/BLLayer/authcheck.php"; 
include __DIR__ . "/../Class/BLLayer/customerHandler.php"; 
include __DIR__ . "/../navbar.php";
?>

<div class="container  Adjust_Screen">
  <div class="card shadow-lg border-0">
    <div class="card-header custom-header text-white">
      <h3 class="mb-0">
        <i class="bi bi-person-badge-fill me-2"></i> <?= $Heading ?>
      </h3>
    </div>
    <div class="card-body">
      <form method="POST">
        <input type="hidden" name="Id" value="<?= htmlspecialchars($Customer['Id']); ?>">

        <!-- Customer Name -->
        <div class="mb-3">
          <label class="form-label fw-bold">Customer Name *</label>
          <input type="text" 
                 name="Customer_Name" 
                 pattern="^[A-Za-z\s'-]{2,50}$"  
                 class="form-control" 
                 value="<?= htmlspecialchars($Customer['Customer_Name']); ?>" 
                 placeholder="Enter customer name"
                 required>
          <div class="form-text text-muted">2–50 letters only, spaces and hyphens allowed.</div>
        </div>

        <!-- Phone Number -->
        <div class="mb-3">
          <label class="form-label fw-bold">Phone Number *</label>
          <input type="text" 
                 name="Phone_Number" 
                 pattern="^(?:\+92|92|0)3[0-9]{2}-?[0-9]{7}$" 
                 class="form-control" 
                 value="<?= htmlspecialchars($Customer['Phone_Number']); ?>" 
                 placeholder="e.g. 0301-2345678 or +923001234567"
                 required>
          <div class="form-text text-muted">Format: Pakistani mobile numbers only.</div>
        </div>

        <!-- Email -->
        <div class="mb-3">
          <label class="form-label fw-bold">Email *</label>
          <input type="email" 
                 name="Email" 
                 class="form-control" 
                 value="<?= htmlspecialchars($Customer['Email']); ?>" 
                 placeholder="Enter customer email"
                 required>
        </div>

        <!-- Battery Model -->
        <div class="mb-3">
          <label class="form-label fw-bold">Battery Model *</label>
          <select name="Battery_ID" class="form-select" required>
            <?php foreach ($batteries as $battery): ?>
              <option value="<?= $battery['Id'] ?>" <?= $Customer['Battery_ID'] == $battery['Id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($battery['Model_Name']); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Sale Date -->
        <div class="mb-3">
          <label class="form-label fw-bold">Sale Date *</label>
          <input type="datetime-local" 
                 name="Sale_Date" 
                 class="form-control" 
                 value="<?= htmlspecialchars($Customer['Sale_Date']); ?>" 
                 required>
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-end gap-2 mt-4">
          <button type="submit" class="btn btn-success px-4">
            <i class="bi bi-check-circle me-1"></i> Update
          </button>
          <a href="customerInforecord.php" class="btn btn-outline-secondary px-4">
            <i class="bi bi-x-circle me-1"></i> Cancel
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include __DIR__ . "/../footer.php"; ?>
