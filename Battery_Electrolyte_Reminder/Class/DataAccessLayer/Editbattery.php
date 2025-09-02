// --- Handle Update (when form is submitted) ---
<?php
include "DatabaseCon.php";
class EditBattery {
   private $conn;

    $update_sql = "UPDATE battery 
                   SET Model_Name=?, Warranty=?, Battery_Code=?, SaleDate=?, Last_Updated_at=NOW() 
                   WHERE Id=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssssi", $Model_Name, $Warranty, $Battery_Code, $SaleDate, $Id);

    if ($stmt->execute()) {
        echo "<script>alert('Record Updated Successfully'); window.location.href='Record.php';</script>";
        exit;
    } else {
        echo "<script>alert('Update Failed');</script>";
    }
}

// --- Fetch Data for Editing (GET request) ---
if (isset($_GET['Id'])) {
    $Id = intval($_GET['Id']);

    $sql = "SELECT * FROM battery WHERE Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $Id);
    $stmt->execute();
    $result = $stmt->get_result();
    $battery = $result->fetch_assoc();

    if (!$battery) {
        die("Record not found.");
    }
} else {
    die("Invalid Request.");
}
?>