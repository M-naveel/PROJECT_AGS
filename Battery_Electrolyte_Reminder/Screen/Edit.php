<?php
$pagename ="Battery Edit Form";
include __DIR__ . "/../Class/BLLayer/AuthCheck.php";

include __DIR__ . "/../Class/DataAccessLayer/Editbattery.php";
// Create an instance of the EditBattery class
$editBattery = new EditBattery();

// Get battery ID from URL
if (!isset($_GET['Id'])) {
    die("No battery ID specified.");
}
$id = intval($_GET['Id']);

// Fetch the battery record
$battery = $editBattery->getBatteryById($id);
if (!$battery) {
    die("Battery not found.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'Model_Name'   => $_POST['Model_Name'],
        'Warranty_No'  => $_POST['Warranty_No'],
        'Battery_Code' => $_POST['Battery_Code'],
        'Sale_Date'    => $_POST['Sale_Date'],
        'Status'       => $_POST['Status'],
        'Updated_By'   => $_SESSION['username'],
        'Updated_At'   => date('Y-m-d H:i:s')
    ];
    
    // Update using the DAL
    $editBattery->updateBattery($id, $data);
    
    
    // Redirect to record list
    header("Location: Record.php");
    exit;
}
include __DIR__ . "/../Navbar.php";
?>

<div class="container mt-5 Adjust_Screen">
    <h2><?php echo $pagename ?? "System" ?></h2>
    <form method="POST">
        <div class="mb-3">
            <label for="Model_Name" class="form-label">Model Name</label>
            <input type="text"  pattern="^^[A-Za-z]+(?:-[A-Za-z]+)?\s\d{2,4}$" id="Model_Name" name="Model_Name" placeholder="e.g. DC 150 or SP-Tall 2000"  class="form-control" value="<?= htmlspecialchars($battery['Model_Name']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="Warranty_No" class="form-label">Warranty No</label>
            <input type="text" id="Warranty_No" pattern="^[A-Za-z0-9]{12}$"  placeholder="e.g. AB12CD34EF56" name="Warranty_No" class="form-control" value="<?= htmlspecialchars($battery['Warranty_No']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="Battery_Code" class="form-label">Battery Code</label>
            <input type="text" pattern="^[A-Z0-9]{3,10}$" 
 placeholder="e.g. DC150 or SP2000" id="Battery_Code" name="Battery_Code" class="form-control" value="<?= htmlspecialchars($battery['Battery_Code']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="Status" class="form-label">Status</label>
            <select id="Status" name="Status" class="form-select">
                <option value="active" <?= $battery['Status'] === 'active' ? 'selected' : ''; ?>>Active</option>
                <option value="inactive" <?= $battery['Status'] === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success mb-5">Update</button>
        <a href="Record.php" class="btn btn-secondary mb-5">Cancel</a>
    </form>
</div>

<?php include __DIR__ . "/../Footer.php";?>

