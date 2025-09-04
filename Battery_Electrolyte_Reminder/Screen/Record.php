<?php 
$pageTitle ="Battery Record";
$pagename ="Battery Record";

include __DIR__ . "/../Class/BLLayer/authcheck.php"; 
include __DIR__ . "/../navbar.php";
include __DIR__ . "/../Class/DataAccessLayer/batteryDAL.php";

$batteryDAL = new BatteryDAL();
$batteries = $batteryDAL->getAllBatteries();
?>

<div class="container Adjust_screen my-5">
  <div class="card shadow-lg border-0">
    <div class="card-header  custom-header d-flex align-items-center justify-content-between">
      <h3 class="mb-0"><i class="bi bi-battery me-2"></i> <?= $pagename ?? "System" ?></h3>
      <a href="BatteryForm.php" class="btn btn-light btn-sm">
        <i class="bi bi-plus-circle"></i> Add Battery
      </a>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-striped align-middle" id="DataTable">
          <thead class="table-dark">
            <tr>
              <th>Battery Id</th>
              <th>Model Name</th>
              <th>Warranty No</th>
              <th>Battery Code</th>
              <th>Updated At</th>
              <th>Updated By</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($batteries)): ?>
              <?php foreach ($batteries as $battery): ?>
                <tr>
                  <td><?= htmlspecialchars($battery['Id']); ?></td>
                  <td><?= htmlspecialchars($battery['Model_Name']); ?></td>
                  <td><?= htmlspecialchars($battery['Warranty_No']); ?></td>
                  <td><?= htmlspecialchars($battery['Battery_Code']); ?></td>
                  <td><?= htmlspecialchars($battery['Updated_At']); ?></td>
                  <td><?= htmlspecialchars($battery['Updated_By']); ?></td>
                  <td class="text-center">
                    <div class="btn-group" role="group">
                      <a href="editBattery.php?Id=<?= $battery['Id']; ?>" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-pencil-square"></i> Edit
                      </a>
                      <a href="/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Class/BLLayer/batteryDeleteHandler.php?Id=<?= $battery['Id']; ?>" 
                         class="btn btn-sm btn-outline-danger" 
                         onclick="return confirm('Are you sure you want to delete this battery?');">
                        <i class="bi bi-trash"></i> Delete
                      </a>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="7" class="text-center text-muted">No batteries found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include "../footer.php"; ?>
