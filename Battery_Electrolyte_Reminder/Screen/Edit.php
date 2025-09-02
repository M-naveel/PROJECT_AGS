<?php include __DIR__ . "/../Class/DataAccessLayer/EditBattery.php";?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Battery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Battery form</h2>
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
      
        <button type="submit" class="btn btn-success">Update</button>
        <a href="Record.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php 
include __DIR__ . "/../Footer.php";
?>
