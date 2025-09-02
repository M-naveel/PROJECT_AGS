<?php 
<<<<<<< Updated upstream
$pageTitle ="Add_Customer";
=======
$pageTitle ="Customer_Info";
>>>>>>> Stashed changes
$pagename ="Customer_Info";
include __DIR__ . "/../Navbar.php";
include __DIR__ . "/../Class/DataAccessLayer/Insert.php";
include __DIR__ . "/../Class/DataAccessLayer/GetCustomer.php";

?>
<<<<<<< Updated upstream
  <div class="container mt-5 
=======
  <div class="container mx:0  
>>>>>>> Stashed changes
 Adjust_screen">
    <h2 class="mb-4">Customer Info Record </h2>

    <table class="table table-bordered" id="DataTable">
        <thead>
          <tr>
          <th>Customer_Id</th>
            <th>Customer_Name</th>
            <th>Phone_Number</th>
            <th>Email</th>
            <th>Sale Date</th>
<<<<<<< Updated upstream
            <th>Battery Id</th>
=======
            <th>Battery Name</th>
>>>>>>> Stashed changes
            <th>Updated_At</th>
            <th>Updated_By</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($row); $i++): ?>
            <tr>
                <td id="line-"><?=  $row[$i]['Id'] ?></td>
                <td><?= $row[$i]['Customer_Name'] ?></td>
                <td><?= $row[$i]['Phone_Number'] ?></td>
                <td><?= $row[$i]['Email'] ?></td>
<<<<<<< Updated upstream
                <td><?= $row[$i]['Sale_date'] ?></td>
                <td><?= $row[$i]['batteryids'] ?></td>
                <td><?= $row[$i]['Last_Updated_at'] ?></td>
                <td><?= $row[$i]['Last_Updated_By'] ?></td>
                <td>
                              <form action="CustomerEdit.php" method="POST">
   
    <a href="CustomerEdit.php?Id=<?= $row[$i]['Id']; ?>" class="btn btn-sm btn-primary">Edit</a>

</form>
=======
                <td><?= $row[$i]['Sale_Date'] ?></td>
                <td><?= $row[$i]['Battery_Name'] ?></td>
                <td><?= $row[$i]['Updated_At'] ?></td>
                <td><?= $row[$i]['Updated_By'] ?></td>
                <td>
                  <div class="row">
                    <div class="col-6">
                      <form action="CustomerEdit.php" method="POST">
   
                        <a href="CustomerEdit.php?Id=<?= $row[$i]['Id']; ?>" class="btn btn-sm btn-primary">Edit</a>


                      </form>
                    </div>
                      <div class="col-6">
                        <form action="/GitHub/PROJECT_AGS/PROJECT_AGS/Battery_Electrolyte_Reminder/Class/DataAccessLayer/CustomerDelete.php" method="POST" style="display:inline-block;" >
                          <a href="/GitHub/PROJECT_AGS/PROJECT_AGS/Battery_Electrolyte_Reminder/Class/DataAccessLayer/CustomerDelete.php?Id=<?= $row[$i]['Id']; ?>" class="btn btn-sm btn-primary">Delete</a>

                        </form>
                      </div>
                  </div>
                      

>>>>>>> Stashed changes

                </td>
        </tr>
        <?php endfor; ?>
           
        
        
      </tbody>
    </table>

       <a href="Add_Customer_Info.php" class="btn btn-primary mb-5">Back to Form</a>
      </div>

  <?php include "../Footer.php"; ?>

<script  src="../Js/myjs.js"></script>


