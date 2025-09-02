<?php 
$pageTitle ="Add Form";
$pagename ="Dispa";

include "DatabaseCon.php"; // your DB connection

$sql = "SELECT c.*, b.Model_Name
        FROM customers c
        JOIN battery b ON c.Battery_ID = b.Id
        WHERE c.is_deleted = 0
          AND DATEDIFF(CURDATE(), c.Sale_Date) % 15 = 0";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Electrolyte Reminder Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Battery Electrolyte Due Today</h2>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Battery Model</th>
                <th>Sale Date</th>
                <th>Days Since Sale</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['Customer_Name']); ?></td>
                        <td><?= htmlspecialchars($row['Phone_Number']); ?></td>
                        <td><?= htmlspecialchars($row['Email']); ?></td>
                        <td><?= htmlspecialchars($row['Model_Name']); ?></td>
                        <td><?= htmlspecialchars($row['Sale_Date']); ?></td>
                        <td><?= floor((strtotime(date('Y-m-d')) - strtotime($row['Sale_Date'])) / 86400); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="6" class="text-center">No batteries due today.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>



<?php include "../Footer.php"?>
