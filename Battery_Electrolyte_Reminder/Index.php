
    
  <?php 
$pageTitle ="DashBoard";
$pagename ="DashBoard";
include __DIR__ . "/Navbar.php";
include __DIR__ ."/./Class/DataAccessLayer/DatabaseCon.php"; // your DB connection
include __DIR__ . "/./Class/DataAccessLayer/GetCustomer.php";
include __DIR__ . "/./Class/DataAccessLayer/GetBatteryName.php";
include __DIR__ . "/./Class/DataAccessLayer/FilterIndex.php";
// include __DIR__ . "/./Class/DataAccessLayer/Reminder.php";


?>

<!-- Filter  -->
 
 <div class="container mt-5">
 <form method="GET" class="row g-3 mb-4 Adjust_screen">
    <div class="col-md-4">
        <input type="text" name="customer" class="form-control" 
               placeholder="Search by Customer Name" 
               value="<?= htmlspecialchars($_GET['customer'] ?? '') ?>">
    </div>
    

    
    <div class="col-md-3">
        <select name="battery" class="form-select">
            <option value="">All Batteries</option>
            <?php
            $batteryRes = $conn->query("SELECT Id, Model_Name FROM battery WHERE is_deleted = 0");
            while ($b = $batteryRes->fetch_assoc()):
                $selected = ($_GET['battery'] ?? '') == $b['Id'] ? 'selected' : '';
            ?>
                <option value="<?= $b['Id'] ?>" <?= $selected ?>><?= htmlspecialchars($b['Model_Name']) ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="col-md-3">
        <input type="date" name="date" class="form-control" 
               value="<?= htmlspecialchars($_GET['date'] ?? '') ?>">
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-100">Filter</button>
    </div>
</form>
</div>

<!-- Filter ends here -->
<div class="container my-5 Adjust_screen">
    <h2>Battery Electrolyte Reminder Dashboard</h2>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Battery Model</th>
                <th>Sale Date</th>
                <th>Next Reminder Date</th>
                <th>Days Since Sale</th>
                <th>status</th>
            </tr>
        </thead>
 <tbody>
<?php 
// alert will store all the messages like an array to display the messages for the overdues or dues batteries
$alerts = []; // store alert messages

// Logic to calculate the check the current date from the sale date 
// the floor is used to roundsdown the value like 1.7 to 1
if ($result->num_rows > 0): 
    while($row = $result->fetch_assoc()):
        $todayTs = strtotime(date('Y-m-d'));
        $saleTs  = strtotime($row['Sale_Date']);
        $daysSinceSale = max(0, floor(($todayTs - $saleTs) / 86400));

        // Status logic
        // it will check the status that how many days have been passed since the battery is sold
        if ($daysSinceSale < 15) {
            $statusText  = 'Upcoming';
            $statusClass = 'text-success fw-bold';
        } elseif ($daysSinceSale % 15 === 0) {
            $statusText  = 'Due Today';
            $statusClass = 'text-warning fw-bold';
            $alerts[] = "Battery for {$row['Customer_Name']} (Model: {$row['Model_Name']}) is due today!";
        } else {
            $statusText  = 'Overdue';
            $statusClass = 'text-danger fw-bold';
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
            <td class="<?= $statusClass ?>"><?= $daysSinceSale; ?></td>
            <td class="<?= $statusClass ?>"><?= $statusText; ?></td>
        </tr>
    <?php endwhile; ?>
<?php else: ?>
    <tr><td colspan="8" class="text-center">No batteries found.</td></tr>
<?php endif; ?>
</tbody>
    </table>
</div>
<?php if (!empty($alerts)): ?>
<!-- Bootstrap Modal -->
<div class="modal fade" id="batteryAlertModal" tabindex="-1" aria-labelledby="batteryAlertLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="batteryAlertLabel">⚠️ Battery Alerts</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul class="list-group">
          <?php foreach ($alerts as $alert): ?>
            <li class="list-group-item"><?= htmlspecialchars($alert) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
      <?php endif; ?> <!-- Closing the if statement -->
      
      <script src="./Js/myjs.js"></script>
      <!-- Footer -->
    
    <?php include "Footer.php";?>
    