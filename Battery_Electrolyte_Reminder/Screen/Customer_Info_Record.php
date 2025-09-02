<?php 
$pageTitle ="Add_Customer";
$pagename ="Customer_Info";
include __DIR__ . "/../Navbar.php";
include __DIR__ . "/../Class/DataAccessLayer/Insert.php";
include __DIR__ . "/../Class/DataAccessLayer/GetCustomer.php";

?>
  <div class="container mt-5 
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
            <th>Battery Id</th>
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
                <td><?= $row[$i]['Sale_date'] ?></td>
                <td><?= $row[$i]['batteryids'] ?></td>
                <td><?= $row[$i]['Last_Updated_at'] ?></td>
                <td><?= $row[$i]['Last_Updated_By'] ?></td>
                <td>
                  <div class="row">
                    <div class="col-6">
                      <form action="CustomerEdit.php" method="POST">
   
                        <a href="CustomerEdit.php?Id=<?= $row[$i]['Id']; ?>" class="btn btn-sm btn-primary">Edit</a>

</form>

                </td>
        </tr>
        <?php endfor; ?>
           
        
        
      </tbody>
    </table>

       <a href="Add_Customer_Info.php" class="btn btn-primary mb-5">Back to Form</a>
      </div>

  <?php include "../Footer.php"; ?>

<script  src="../Js/myjs.js"></script>


