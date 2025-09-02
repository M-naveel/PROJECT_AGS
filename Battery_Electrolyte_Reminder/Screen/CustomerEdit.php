<?php
include __DIR__ . "/../Class/BLLayer/AuthCheck.php";
 include __DIR__ . "/../Navbar.php";
include __DIR__ . "/../Class/DataAccessLayer/EditCustomer.php";

$editCustomer = new EditCustomer();

// Get customer ID from URL
if (!isset($_GET['Id'])) {
    die("No customer ID specified.");
}
$id = intval($_GET['Id']);

// Fetch customer and batteries
$Customer = $editCustomer->getCustomerById($id);
$batteries = $editCustomer->getAllBatteries();

if (!$Customer) {
    die("Customer not found.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'Customer_Name' => $_POST['Customer_Name'],
        'Phone_Number'  => $_POST['Phone_Number'],
        'Email'         => $_POST['Email'],
        'Battery_ID'    => $_POST['Battery_ID'],
        'Updated_By'    => $_POST['Updated_By'],
        'Updated_At'    => $_POST['Updated_At'],
        'Sale_Date'     => $_POST['Sale_Date'],
        'Status'        => $_POST['Status'],
    ];

    $editCustomer->updateCustomer($id, $data);

    header("Location: Customer_Info_Record.php");
    exit;
}
?>

<div class="container mt-5 Adjust_Screen">
    <h2>Edit Customer</h2>
    <form method="POST">
        <input type="hidden" name="Id" value="<?= htmlspecialchars($Customer['Id']); ?>">

        <div class="mb-3">
            <label>Customer Name</label>
            <input type="text" name="Customer_Name" class="form-control" value="<?= htmlspecialchars($Customer['Customer_Name']); ?>" required>
        </div>

        <div class="mb-3">
            <label>Phone Number</label>
            <input type="text" name="Phone_Number" class="form-control" value="<?= htmlspecialchars($Customer['Phone_Number']); ?>" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="Email" class="form-control" value="<?= htmlspecialchars($Customer['Email']); ?>" required>
        </div>

        <div class="mb-3">
            <label>Battery Model</label>
            <select name="Battery_ID" class="form-select" required>
               
                 <?php for ($i = 0; $i < count($batteries); $i++): ?>
        <option value="<?= $batteries[$i]['Id'] ?>">
            <?= $batteries[$i]['Model_Name'] ?>
        </option>
    <?php endfor; ?>
              
            </select>
        </div>

        <div class="mb-3">
            <label>Updated By</label>
            <input type="text" name="Updated_By" class="form-control" value="<?= htmlspecialchars($Customer['Updated_By']); ?>">
        </div>

        <div class="mb-3">
            <label>Updated At</label>
            <input type="datetime-local" name="Updated_At" class="form-control" value="<?= htmlspecialchars($Customer['Updated_At']); ?>">
        </div>

        <div class="mb-3">
            <label>Sale Date</label>
            <input type="datetime-local" name="Sale_Date" class="form-control" value="<?= htmlspecialchars($Customer['Sale_Date']); ?>">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="Status" class="form-select">
                <option value="active" <?= ($Customer['Status'] === 'active') ? 'selected' : ''; ?>>Active</option>
                <option value="inactive" <?= ($Customer['Status'] === 'inactive') ? 'selected' : ''; ?>>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success mb-5">Update</button>
        <a href="Customer_Info_Record.php" class="btn mb-5 btn-secondary">Cancel</a>
    </form>
</div>
<?php include __DIR__ . "/../Footer.php";?>
