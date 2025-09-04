<?php 
$pageTitle ="Customer_Info";
$pagename ="Customer_Info";

include __DIR__ . "/../Class/BLLayer/authcheck.php"; 
include __DIR__ . "/../navbar.php";
include __DIR__ . "/../Class/DataAccessLayer/customerDAL.php";

$customerDAL = new CustomerDAL();
$customers = $customerDAL->getAllCustomers();
?>

<div class="container Adjust_screen my-4 p-0">
   <div class="card shadow-lg border-0">
    <div class="card-header text-white  custom-header d-flex align-items-center justify-content-between">
      <h3 class="mb-0 "><i class="bi bi-battery me-2"></i> <?= $pagename ?? "System" ?></h3>
      <a href="addCustomerInfo.php" class="btn btn-light btn-sm">
        <i class="bi bi-plus-circle"></i> Add Battery
      </a>
    </div>
    <div class="card-body">

  <table class="table table-hover table-striped align-middle" id="DataTable">
    <thead class="table-dark text-center">
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
      <?php if (!empty($customers)): ?>
        <?php foreach ($customers as $customer): ?>
          <tr>
            <td><?= htmlspecialchars($customer['Id']); ?></td>
            <td><?= htmlspecialchars($customer['Customer_Name']); ?></td>
            <td><?= htmlspecialchars($customer['Phone_Number']); ?></td>
            <td><?= htmlspecialchars($customer['Email']); ?></td>
            <td><?= htmlspecialchars($customer['Sale_Date']); ?></td>
            <td><?= htmlspecialchars($customer['Battery_Name']); ?></td>
            <td><?= htmlspecialchars($customer['Updated_At']); ?></td>
            <td><?= htmlspecialchars($customer['Updated_By']); ?></td>
            <td class="text-center">
              <div class="d-flex justify-content-center gap-2">
                <a href="customerEdit.php?Id=<?= $customer['Id']; ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                <a href="/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Class/BLLayer/customerDeleteHandler.php?Id=<?= $customer['Id']; ?>" 
                   class="btn btn-sm btn-outline-danger"
                   onclick="return confirm('Are you sure you want to delete this customer?');">
                   Delete
                </a>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="9" class="text-center text-muted">No customers found.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
  </div>
      </div>
</div>

<?php include "../footer.php"; ?>
