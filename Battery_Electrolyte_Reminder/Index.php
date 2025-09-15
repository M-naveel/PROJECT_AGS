
<?php 
$pageTitle ="Electrolyte Refil Reminder";
$pagename ="Electrolyte Refil Reminder";
$Heading ="Battery Electrolyte Refil Reminder Dashboard";

// Include authcheck to protect page
include __DIR__ . "/./Class/BLLayer/authcheck.php";
include __DIR__ . "/navbar.php";
include __DIR__ ."/./Class/DataAccessLayer/DatabaseCon.php"; 
include __DIR__ . "/./Class/DataAccessLayer/filterDAL.php";
// include __DIR__ . "/./Class/BLLayer/BatteryReminder.php";
include __DIR__ . "/./Class/BLLayer/filterBLL.php";

$filterBLL = new FilterBLL($conn);
$filters = [
    'customer'   => $_GET['customer'] ?? '',
    'battery'    => $_GET['battery'] ?? '',
    'start_date' => $_GET['start_date'] ?? '',
    'end_date'   => $_GET['end_date'] ?? ''
];
$result = $filterBLL->getSalesWithFilters($filters);
$ca = new filterDAL($conn);
$stats = $ca->getDashboardStats($conn);
$battery = $stats['totalBatteries'];
$Customers = $stats['customers'];
$Due = $stats['Dues'];
?>

<div class="container Adjust_screen">
    <div class="text-center mt-4">
        <h2 class="fw-bold text-primary" id="title">
            🔋 Battery Electrolyte Refill Reminder
        </h2>
        <p class="text-muted">Track upcoming, due, and overdue battery reminders</p>
 <div class="row g-4">

    <!-- Total Batteries -->
    <div class="col-md-3">
      <div class="card shadow-sm border-0 text-center">
        <div class="card-body">
          <i class="bi bi-battery-charging text-success display-6"></i>
          <h5 class="card-title mt-2">Total Batteries</h5>
          <h2 class="fw-bold"><?php echo $battery ?></h2>
          <p class="text-muted">Active in System</p>
        </div>
      </div>
    </div>

    <!-- Battery Health -->
    <div class="col-md-3">
      <div class="card h-100 shadow-sm border-0 text-center">
        <div class="card-body">
          <i class="bi bi-heart-pulse text-danger display-6"></i>
          <h5 class="card-title mt-2">Customer</h5>
          <h6 class="fw-bold">
            <h2 class="fw-bold"><?php echo $Customers ?></h2>
</h6>

          <p class="text-muted">Active in system</p>
        </div>
      </div>
    </div>

    <!-- Electrolyte Alerts -->
    <div class="col-md-3">
      <div class="card shadow-sm border-0 text-center">
        <div class="card-body">
          <i class="bi bi-bell-fill text-warning display-6"></i>
          <h5 class="card-title mt-2">Electrolyte Alerts</h5>
          <h2 class="fw-bold"><?php echo $Due ?></h2>
          <p class="text-muted">Attention Needed</p>
        </div>
      </div>
    </div>

    <!-- Upcoming Maintenance -->
    <div class="col-md-3">
      <div class="card shadow-sm border-0 text-center">
        <div class="card-body">
          <i class="bi bi-calendar-event text-primary display-6"></i>
          <h5 class="card-title mt-2">Upcoming Maintenance</h5>
          <h2 class="fw-bold"><?php echo $stats['next']; ?></h2>
          <p class="text-muted">Within 7 Days</p>
        </div>
      </div>
    </div>

  </div>
</div>



<!-- card ends here -->

    <!-- Filter Section -->
    <div class="card   shadow-sm mb-4">
        <div class="card-header custom-header  text-white">
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
                    <button type="submit" class="btn  custom-header w-100">
                        <i class=" bi bi-search">Search</i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table Section -->
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <strong>Sale Records</strong>
        </div>
        <div class="card-body mb-5">
            <table class="table table-hover table-striped align-middle" id="DataTable">
                <thead class="table-dark">
                    <tr>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Battery Model</th>
                        <th>Sale Date</th>
                        <th>Next Service Date</th>
                        <th>Days since LastService
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
               $alerts = []; 
if ($result->num_rows > 0): 

    while($row = $result->fetch_assoc()):
       $todayTs   = strtotime(date('Y-m-d'));
$saleTs    = strtotime($row['Sale_Date']);
$expiryTs  = strtotime($row['Warranty_Expiry_Date']);
$lastServiceDate = !empty($row['Last_Service_Date']) ? $row['Last_Service_Date'] : $row['Sale_Date'];

$serviceTs = strtotime($lastServiceDate);
$todayTs   = strtotime(date("Y-m-d"));

$daysSinceSale = max(0, floor(($todayTs - $serviceTs) / 86400));

// $daysSinceSale = max(0, floor(($todayTs - $saleTs) / 86400));

if ($todayTs > $expiryTs) {
    // 🚨 Warranty expired logic
    $statusText  = 'Warranty Expired';
    $statusBadge = 'secondary';
} else {
    // Normal reminder logic
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
                        <td class="d-flex">
    <span class="mt-4 badge bg-<?= $statusBadge ?>"><?= $statusText; ?></span>
    <span >

    <?php if (in_array($statusText, ['Due Today', 'Overdue'])): ?>
        <form action="/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Class/BLLayer/sendReminder.php" method="POST" class="d-inline">
            <input type="hidden" name="email" value="<?= htmlspecialchars($row['Email']); ?>">
            <input type="hidden" name="customer" value="<?= htmlspecialchars($row['Customer_Name']); ?>">
            <input type="hidden" name="battery" value="<?= htmlspecialchars($row['Model_Name']); ?>">
            <input type="hidden" name="CustomerId" value="<?= htmlspecialchars($row['Id']); ?>">
            <?php if($username=="ADMIN"){ ?>
            <button type="submit" class="btn btn-sm btn-outline-primary mt-4" id="loader">
                <i class="bi bi-envelope-fill "></i> Notify
            </button>
            <?Php }?>
        </form>
    <?php endif; ?>
</span>
</td>

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
        <h5 class="modal-title" id="batteryAlertLabel">Electrolyte Refi Alerts</h5>
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
<!-- Loader Overlay (only one, global) -->
<div id="loaderOverlay" style="
    display: none; 
    position: fixed; 
    top: 0; 
    left: 0; 
    width: 100%; 
    height: 100%; 
    background: rgba(255,255,255,0.8); 
    z-index: 9999; 
    text-align: center;
    padding-top: 20%;
">
    <div class="spinner-border text-primary" role="status" style="width: 4rem; height: 4rem;"></div>
    <p class="mt-3 fw-bold">📧 Sending email, please wait...</p>
</div>

</script>
<?php endif; ?>
<script>
    

</script>
