<?php
include __DIR__ . "/../Class/DataAccessLayer/Editbattery.php";
include __DIR__ . "/../Navbar.php";

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
        'Updated_By'   => $_POST['Updated_By'],
        'Updated_At'   => $_POST['Updated_At'],
    ];

    // Update using the DAL
    $editBattery->updateBattery($id, $data);

    // Redirect to record list
    header("Location: Record.php");
    exit;
}
?>


<div class="container mt-5 Adjust_screen">
    <h2>Edit Battery</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="Model_Name" class="form-label">Model Name</label>
            <input type="text" id="Model_Name" name="Model_Name" class="form-control" value="<?= htmlspecialchars($battery['Model_Name']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="Warranty_No" class="form-label">Warranty No</label>
            <input type="text" id="Warranty_No" name="Warranty_No" class="form-control" value="<?= htmlspecialchars($battery['Warranty_No']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="Battery_Code" class="form-label">Battery Code</label>
            <input type="text" id="Battery_Code" name="Battery_Code" class="form-control" value="<?= htmlspecialchars($battery['Battery_Code']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="Sale_Date" class="form-label">Sale Date</label>
            <input type="datetime-local" id="Sale_Date" name="Sale_Date" class="form-control" value="<?= htmlspecialchars($battery['Sale_Date']??''); ?>">
        </div>

        <div class="mb-3">
            <label for="Status" class="form-label">Status</label>
            <select id="Status" name="Status" class="form-select">
                <option value="active" <?= $battery['Status'] === 'active' ? 'selected' : ''; ?>>Active</option>
                <option value="inactive" <?= $battery['Status'] === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="Updated_By" class="form-label">Updated By</label>
            <input type="text" id="Updated_By" name="Updated_By" class="form-control" value="<?= htmlspecialchars($battery['Updated_By'] ?? ''); ?>">
        </div>

        <div class="mb-3">
            <label for="Updated_At" class="form-label">Updated At</label>
            <input type="datetime-local" id="Updated_At" name="Updated_At" class="form-control" value="<?= htmlspecialchars($battery['Updated_At'] ?? ''); ?>">
        </div>
        <div class="mb-5">
        <button type="submit" class="btn btn-success">Update</button>
        <a href="Record.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php 
include __DIR__ . "/../Footer.php";
?>
