<?php 
$pageTitle ="Customer_Info";
$pagename ="Customer_Info";
include __DIR__ . "/../Class/BLLayer/AuthCheck.php"; 
include __DIR__ . "/../Navbar.php";
include __DIR__ . "/../Class/DataAccessLayer/Insert.php";
include __DIR__ . "/../Class/DataAccessLayer/GetCustomer.php";

?>
<div class="container mx:0 Adjust_screen">
  <h2 id="title" class="mb-4"><?php echo $pagename ?? "System" ?></h2>

  <table class="table table-bordered" id="DataTable">
    <thead>
      <tr>
        <th>Customer_Id</th>
        <th>Customer_Name</th>
        <th>Phone_Number</th>
        <th>Email</th>
        <th>Sale Date</th>
        <th>Battery Name</th>
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
        <td><?= $row[$i]['Sale_Date'] ?></td>
        <td><?= $row[$i]['Battery_Name'] ?></td>
        <td><?= $row[$i]['Updated_At'] ?></td>
        <td><?= $row[$i]['Updated_By'] ?></td>
        <td >
          <div class="d-flex justify-content-center gap-2">
            
              <form action="CustomerEdit.php" method="POST">
                <a
                  href="CustomerEdit.php?Id=<?= $row[$i]['Id']; ?>"
                  class="btn btn-primary"
                  >Edit</a
                >
              </form>
        
              <form
                action="/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Class/DataAccessLayer/CustomerDelete.php"
                method="POST"
              >
                <a
                  href="/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Class/DataAccessLayer/CustomerDelete.php?Id=<?= $row[$i]['Id']; ?>"
                  class="btn  btn-danger"
                  >Delete</a
                >
              </form>
            
          </div>
        </td>
      </tr>
      <?php endfor; ?>
    </tbody>
  </table>

  <a href="Add_Customer_Info.php" class="btn btn-primary mb-5">Back to Form</a>
</div>

<?php include "../Footer.php"; ?>

<!-- <script  src="../Js/myjs.js"></script> -->
