<<<<<<< Updated upstream

    
  <?php 
$pageTitle ="DashBoard";
$pagename ="DashBoard";
include __DIR__ . "/./Navbar.php";
?>



<!-- DASHBOAR -->
    <div class="container dashboard_body  Adjust_screen">
    
      <div class="dashboard ">
          
          <div class="main " id="bg" >
          
            <div class="card">
              <h3>Users</h3>
              <p>1,024</p>
            </div>
            
          </div>
      </div>
    </div>
      
=======
<?php 
include __DIR__ . "/Navbar.php";
$pageTitle ="DashBoard";
$pagename ="DashBoard";
include __DIR__ ."/./Class/DataAccessLayer/DatabaseCon.php"; // your DB connection
include __DIR__ . "/./Class/DataAccessLayer/GetCustomer.php";
include __DIR__ . "/./Class/DataAccessLayer/GetBatteryName.php";
// include __DIR__ . "/./Class/DataAccessLayer/Reminder.php";


$sql = "SELECT c.*, b.Model_Name,
               DATE_ADD(c.Sale_Date, INTERVAL (FLOOR(DATEDIFF(CURDATE(), c.Sale_Date)/15)+1)*15 DAY) AS Next_Reminder_Date
        FROM sale c
        JOIN battery b ON c.Battery_ID = b.Id
        WHERE c.is_deleted = 0";

$result = $conn->query($sql);
?>
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
$alerts = []; // store alert messages

if ($result->num_rows > 0): 
    while($row = $result->fetch_assoc()):
        $todayTs = strtotime(date('Y-m-d'));
        $saleTs  = strtotime($row['Sale_Date']);
        $daysSinceSale = max(0, floor(($todayTs - $saleTs) / 86400));

        // Status logic
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
      <div class="modal-header bg-danger text-white">
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
  </div>
</div>

<!-- Script to auto-open modal -->
<script>
    window.onload = function() {
        var alertModal = new bootstrap.Modal(document.getElementById('batteryAlertModal'));
        alertModal.show();
    }
</script>
<?php endif; ?>

<!-- 
<?php if (!empty($alerts)): ?>
<script>
    window.onload = function() {
        <?php foreach ($alerts as $alert): ?>
            alert("<?= addslashes($alert) ?>");
        <?php endforeach; ?>
    }
</script>
<?php endif; ?> -->

>>>>>>> Stashed changes
      <!-- Footer -->
    
    
    <?php include "Footer.php";?>
    