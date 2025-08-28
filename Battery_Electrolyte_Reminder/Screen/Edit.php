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
        <input type="hidden" name="Id" value="<?= htmlspecialchars($battery['Id']); ?>">

        <div class="mb-3">
            <label>Model Name</label>
            <input type="text" name="Model_Name" class="form-control" value="<?= htmlspecialchars($battery['Model_Name']); ?>" required>
        </div>

        <div class="mb-3">
            <label>Warranty</label>
            <input type="text" name="Warranty" class="form-control" value="<?= htmlspecialchars($battery['Warranty']); ?>" required>
        </div>

        <div class="mb-3">
            <label>Battery Code</label>
            <input type="text" name="Battery_Code" class="form-control" value="<?= htmlspecialchars($battery['Battery_Code']); ?>" required>
        </div>

        <div class="mb-3">
            <label>Sale Date</label>
            <input type="date" name="SaleDate" class="form-control" value="<?= htmlspecialchars($battery['SaleDate']); ?>" required>
        </div>
      
        <button type="submit" class="btn btn-success">Update</button>
        <a href="Record.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
