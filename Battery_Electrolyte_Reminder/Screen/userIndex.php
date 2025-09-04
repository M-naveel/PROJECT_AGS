Attractive UI for dashboard
<?php 
$pageTitle ="DashBoard";
$pagename ="DashBoard";
$Heading ="Battery Electrolyte Reminder Dashboard";

// Include authcheck to protect page
include __DIR__ . "/./Class/BLLayer/authcheck.php";
include __DIR__ . "/navbar.php";
include __DIR__ ."/./Class/DataAccessLayer/DatabaseCon.php"; 
include __DIR__ . "/./Class/DataAccessLayer/filterDAL.php";
include __DIR__ . "/./Class/BLLayer/filterBLL.php";

$filterBLL = new FilterBLL($conn);
$filters = [
    'customer'   => $_GET['customer'] ?? '',
    'battery'    => $_GET['battery'] ?? '',
    'start_date' => $_GET['start_date'] ?? '',
    'end_date'   => $_GET['end_date'] ?? ''
];
$result = $filterBLL->getSalesWithFilters($filters);
?>

<div class="container my-5 Adjust_screen">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-primary" id="title">
            🔋 Battery Electrolyte Reminder
        </h2>
        <p class="text-muted">Track upcoming, due, and overdue battery reminders</p>
    </div>

    <!-- Filter Section -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <strong>Filter Records</strong>
        </div>
        <div class="card-body">
            <form method="GET" class="row g-3">
                <!-- Customer Name -->
                <div class="col-md-4">
                    <input type="text" name="customer" class="form-control"
                           placeholder="Search by Customer Name"
                           value="<?= htmlspecialchars($_GET['customer'] ?? '') ?>">
                </div>

                <!-- Battery Dropdown -->
                <div class="col-md-3">
                    <select name="battery" class="form-select">
                        <option value="">All Batteries</option>
                        <?php
                        $batteryRes = $conn->query("SELECT Id, Model_Name FROM battery WHERE is_deleted = 0");
                        while ($b = $batteryRes->fetch_assoc()):
                            $selected = ($_GET['battery'] ?? '') == $b['Id'] ? 'selected' : '';
                        ?>
                            <option value="<?= $b['Id'] ?>" <?= $selected ?>>
                                <?= htmlspecialchars($b['Model_Name']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Start Date -->
                <div class="col-md-2">
                    <input type="date" name="start_date" class="form-control"
                           value="<?= htmlspecialchars($_GET['start_date'] ?? '') ?>">
                </div>

                <!-- End Date -->
                <div class="col-md-2">
                    <input type="date" name="end_date" class="form-control"
                           value="<?= htmlspecialchars($_GET['end_date'] ?? '') ?>">
                </div>

                <!-- Submit Button -->
                <div class="col-md-1 d-flex align-items-end">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-search">Search</i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table Section -->
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <strong>Battery Records</strong>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped align-middle" id="DataTable">
                <thead class="table-dark">
                    <tr>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Battery Model</th>
                        <th>Sale Date</th>
                        <th>Next Reminder</th>
                        <th>Days Since Sale</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $alerts = []; 
                if ($result->num_rows > 0): 
                    while($row = $result->fetch_assoc()):
                        $todayTs = strtotime(date('Y-m-d'));
                        $saleTs  = strtotime($row['Sale_Date']);
                        $daysSinceSale = max(0, floor(($todayTs - $saleTs) / 86400));

                        // Status logic
                        if ($daysSinceSale < 15) {
                            $statusText  = 'Upcoming';
                            $statusBadge = 'success';
                        } elseif ($daysSinceSale % 15 === 0) {
                            $statusText  = 'Due Today';
                            $statusBadge = 'warning';
                            $alerts[] = "Battery for {$row['Customer_Name']} (Model: {$row['Model_Name']}) is due today!";
                        } else {
                            $statusText  = 'Overdue';
                            $statusBadge = 'danger';
                            $alerts[] = "Battery for {$row['Customer_Name']} (Model: {$row['Model_Name']}) is overdue!";
                        }
                ?>
                    <tr>
                        <td><?= htmlspecialchars($row['Customer_Name']); ?></td>
                        <td><?= htmlspecialchars($row['Phone_Number']); ?></td>
                        <td><?= htmlspecialchars($row['Email']); ?></td>
                        <td><?= htmlspecialchars($row['Model_Name']); ?></td>
                        <td><?= htmlspecialchars($row['Sale_Date']); ?></td>
                        <td><?= htmlspecialchars($row['Next_Reminder_Date']); ?></td>
                        <td><span class="badge bg-secondary"><?= $daysSinceSale; ?> days</span></td>
                        <td><span class="badge bg-<?= $statusBadge ?>"><?= $statusText; ?></span></td>
                    </tr>
                <?php endwhile; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>

<?php if (!empty($alerts)): ?>
<!-- Stylish Bootstrap Modal -->
<div class="modal fade" id="batteryAlertModal" tabindex="-1" aria-labelledby="batteryAlertLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow-lg">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="batteryAlertLabel">⚡ Battery Alerts</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul class="list-group list-group-flush">
          <?php foreach ($alerts as $alert): ?>
            <li class="list-group-item">
              <i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>
              <?= htmlspecialchars($alert) ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="Battery_Electrolyte_Reminder\Js\myjs.js">
 
</script>
<?php endif; ?>
