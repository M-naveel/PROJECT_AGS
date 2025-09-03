<?php 
$pageTitle ="Battery Record";
$pagename ="Battery Record";

include __DIR__ . "/../Class/BLLayer/AuthCheck.php"; 

include __DIR__ . "/../Navbar.php";
include __DIR__ . "/../Class/DataAccessLayer/Insert_Battery.php";
include __DIR__ . "/../Class/DataAccessLayer/GetBatteryName.php";
// include __DIR__ . "/../Class/DataAccessLayer/EditbatteryName.php";
// include __DIR__ . "/../Class/DataAccessLayer/Delete_battery.php";
?>

<div class="container Adjust_screen my-5">
  <h2 id="title" class="mb-4 flex-grow-1">
    <?php echo $pagename ?? "System" ?>
  </h2>

  <table class="table table-bordered" id="DataTable">
    <thead>
      <tr>
        <th>Battery_Id</th>
        <th>Model_Name</th>
        <th>Warranty_No</th>
        <th>Battery_Code</th>
        <th>Updated_At</th>
        <th>Updated_By</th>
        <!-- <th>Sale_Date</th> -->
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

        <td>
          <div class="d-flex justify-content-center gap-2">
  <a href="Edit.php?Id=<?= $batteries[$i]['Id']; ?>" class="btn btn-primary">Edit</a>
  <a href="/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Class/DataAccessLayer/Delete_battery.php?Id=<?= $batteries[$i]['Id']; ?>" class="btn btn-danger">Delete</a>
</div>

        </td>
      </tr>
      <?php endfor; ?>
    </tbody>
  </table>
</div>

<?php include "../Footer.php"; ?>
<!-- <script src="../Js/myjs.js"></script> -->
