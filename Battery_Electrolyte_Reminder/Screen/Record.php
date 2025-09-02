<?php 
$pageTitle ="Record";
$pagename ="Record";
include __DIR__ . "/../Class/BLLayer/AuthCheck.php"; 

include __DIR__ . "/../Navbar.php";
include __DIR__ . "/../Class/DataAccessLayer/Insert_Battery.php";
include __DIR__ . "/../Class/DataAccessLayer/GetBatteryName.php";
// include __DIR__ . "/../Class/DataAccessLayer/EditbatteryName.php";
// include __DIR__ . "/../Class/DataAccessLayer/Delete_battery.php";
?>

<div class="container Adjust_screen my-5">
    <h2 class="mb-4 flex-grow-1">Battery Record Submitted</h2>

    <table class="table table-bordered" id="DataTable">
        <thead>
            <tr>
                <th>Battery_Id</th>
                <th>Model_Name</th>
                <th>Warranty_No</th>
                <th>Battery_Code</th>
                <th>Updated_At</th>
                <th>Updated_By</th>
                <th>Sale_Date</th>
                <th>Action</th>
            </tr>
        </thead>
       <tbody>
    <?php for ($i = 0; $i < count($batteries); $i++): ?>
        <tr>
            <td><?= htmlspecialchars($batteries[$i]['Id']); ?></td>
            <td><?= htmlspecialchars($batteries[$i]['Model_Name']); ?></td>
            <td><?= htmlspecialchars($batteries[$i]['Warranty_No']); ?></td>
            <td><?= htmlspecialchars($batteries[$i]['Battery_Code']); ?></td>
            <td><?= htmlspecialchars($batteries[$i]['Updated_At']); ?></td>
            <td><?= htmlspecialchars($batteries[$i]['Updated_By']); ?></td>
            <td><?= htmlspecialchars($batteries[$i]['Sale_Date']); ?></td>
            <td>
                <div class="row">
    <div class="d-flex gap-2">
        <!-- Edit Form -->
      
           <a href="Edit.php?Id=<?= $batteries[$i]['Id']; ?>" class="btn btn-sm btn-primary">Edit</a>

  
    </div>
    <div class="d-flex">
         <div class="col-6">
       <form action="/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Class/DataAccessLayer/Delete_battery.php" method="POST" style="display:inline-block;" >
    <a href="/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Class/DataAccessLayer/Delete_battery.php?Id=<?= $batteries[$i]['Id']; ?>" class="btn btn-sm btn-primary">Delete</a>

</form>
</div>
    </div>
    </div>
</td>

        </tr>
    <?php endfor; ?>
</tbody>

    </table>
</div>

<?php include "../Footer.php"; ?>
<!-- <script src="../Js/myjs.js"></script> -->
