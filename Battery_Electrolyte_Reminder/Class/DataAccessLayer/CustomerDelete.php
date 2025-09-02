<?php 
include "DatabaseCon.php";
include "DatabaseCon.php"; // your DB connection

if (isset($_GET['Id'])) {
    $id = intval($_GET['Id']); // sanitize input

    $sql = "UPDATE sale SET is_deleted = 1 WHERE Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Customer soft-deleted successfully.";
    } else {
        echo "No record found or already deleted.";
    }
    
    header("Location: /GitHub/PROJECT_AGS/PROJECT_AGS/Battery_Electrolyte_Reminder/Screen/Customer_Info_Record.php");
    $stmt->close();
    $conn->close();
} else {
    echo "No customer ID specified.";
}
?>


?>