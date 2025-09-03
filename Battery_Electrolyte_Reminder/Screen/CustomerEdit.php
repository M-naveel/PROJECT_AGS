<?php
$pagename = "Customer_Info";
$Heading  = "Customer Info";

// Only include what's necessary
include __DIR__ . "/../Class/BLLayer/AuthCheck.php"; 

include __DIR__ . "/../Class/DataAccessLayer/EditCustomer.php";
// include __DIR__ . "/../Class/DataAccessLayer/CustomerDAL.php";

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

include __DIR__ . "/../Navbar.php";
?>

<div class="container mt-5 Adjust_Screen">
    <h2><?= $Heading ?></h2>
    <form method="POST" action="../Class/BLLayer/CustomerBLL.php">
        <input type="hidden" name="Id" value="<?= htmlspecialchars($Customer['Id']); ?>">

        <!-- Customer Name -->
        <div class="mb-3">
            <label>Customer Name</label>
            <input type="text" name="Customer_Name" pattern="^[A-Za-z\s'-]{2,50}$"  
                   class="form-control" value="<?= htmlspecialchars($Customer['Customer_Name']); ?>" required>
        </div>

        <!-- Phone Number -->
        <div class="mb-3">
            <label>Phone Number</label>
            <input type="text" name="Phone_Number" pattern="^(?:\+92|92|0)3[0-9]{2}-?[0-9]{7}$" 
                   class="form-control" value="<?= htmlspecialchars($Customer['Phone_Number']); ?>" required>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="Email" class="form-control" value="<?= htmlspecialchars($Customer['Email']); ?>" required>
        </div>

        <!-- Battery Model -->
        <div class="mb-3">
            <label>Battery Model*</label>
            <select name="Battery_ID" class="form-select" required>
                <?php foreach ($batteries as $battery): ?>
                    <option value="<?= $battery['Id'] ?>" <?= $Customer['Battery_ID'] == $battery['Id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($battery['Model_Name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Sale Date -->
        <div class="mb-3">
            <label>Sale Date*</label>
            <input type="datetime-local" name="Sale_Date" class="form-control" value="<?= htmlspecialchars($Customer['Sale_Date']); ?>" required>
        </div>

        <button type="submit" class="btn btn-success mb-5">Update</button>
        <a href="Customer_Info_Record.php" class="btn mb-5 btn-secondary">Cancel</a>
    </form>
</div>

<?php include __DIR__ . "/../Footer.php"; ?>
