<?php 
$pageTitle ="Record";
$pagename ="Record";

include __DIR__ . "/../Navbar.php";
include __DIR__ . "/../Class/DataAccessLayer/Insert_Battery.php";
include __DIR__ . "/../Class/DataAccessLayer/GetBatteryName.php";
// include __DIR__ . "/../Class/DataAccessLayer/Delete_battery.php";


?>


  <div class="container  
 Adjust_screen mY-5" >
    <h2 class="mb-4 flex-grow-1">Battery Record Submitted</h2>

    <table class="table table-bordered  " id="DataTable" >
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
        <?php for ($i = 0; $i < count($row); $i++): ?>
            <tr>
                <td><?= $row[$i]['Id'] ?></td>
                <td><?= $row[$i]['Model_Name'] ?></td>
                <td><?= $row[$i]['Warranty'] ?></td>
                <td><?= $row[$i]['Battery_Code'] ?></td>
                <td><?= $row[$i]['Last_Updated_at'] ?></td>
                <td><?= $row[$i]['Last_Updated_By'] ?></td>
                <td><?= $row[$i]['SaleDate'] ?></td>
                

                <td>
            <!-- Edit Button -->
<div class="row ">
  <div class="col-6">
            <form action="Edit.php" method="POST">
   
    <a href="Edit.php?Id=<?= $row[$i]['Id']; ?>" class="btn btn-sm btn-primary">Edit</a>

</form>
</div>
<div class="col-6">
<!-- 
            
<form action="../Class/DataAccessLayer/Delete_battery.php" method="POST">
   
    <a href="../Class/DataAccessLayer/Delete_battery.php"?Id=<?= $row[$i]['Id']; ?>" class="btn btn-sm btn-primary">Delete</a>
        </form> -->





                    <!-- Delete Button -->
<!--       <form method="POST" style="display:inline;">
                        <input type="hidden" name="delete_id" value="<?php echo $row['Id']; ?>">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this record?');">
                            Delete
                        </button>
                    </form>
 -->
                    <!-- <a href="Delete.php?Id=<?= $row[$i]['Id']; ?>" class="btn btn-sm btn-danger">Delete</a>
    <button class="btn btn-sm btn-danger" onclick="deleteRecord(<?php echo $row[$i]['Id']; ?>)">Delete</button> -->
</div>
</div>
</td>
            </tr>
        <?php endfor; ?>
    </tbody>
    
    </table>


  </div>

  <?php include "../Footer.php"; ?>
<script  src="../Js/myjs.js"></script>
