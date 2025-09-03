<?php 
session_start(); // make sure session is active
include "DatabaseCon.php";

if (isset($_GET['Id'])) {
    $id = intval($_GET['Id']);
    $deletedBy = $_SESSION['username'];
       $deletedAt = date('Y-m-d H:i:s');  

    $sql = "UPDATE battery 
            SET is_deleted = 1, Deleted_At = NOW(), Deleted_By = ? 
            WHERE Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $deletedBy, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Battery row-deleted successfully.'); 
              window.location.href='/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Screen/Record.php';</script>";
    } else {
        echo "<script>alert('No record found or already deleted.'); 
              window.location.href='/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Screen/Record.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No battery ID specified.";
}

?>
