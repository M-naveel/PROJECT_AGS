<?php 
include "DatabaseCon.php";
session_start(); // make sure session is started to access $_SESSION

if (isset($_GET['Id'])) {
    $id = intval($_GET['Id']); // sanitize input
    $deletedBy = $_SESSION['username'];          // logged-in user
    $deletedAt = date('Y-m-d H:i:s');            // current timestamp

    $sql = "UPDATE sale 
            SET is_deleted = 1, Deleted_By = ?, Deleted_At =Now() 
            WHERE Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $deletedBy,  $id);
    $stmt->execute();
if ($stmt->affected_rows > 0) {
        echo "<script>
                alert('Customer Row deleted successfully.');
                window.location.href = '/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Screen/Customer_Info_Record.php';
              </script>";
    } else {
        echo "<script>
                alert('No record found or already deleted.');
                window.location.href = '/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Screen/Customer_Info_Record.php';
              </script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>
            alert('No battery ID specified.');
            window.location.href = '/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Screen/Customer_Info_Record.php';
          </script>";
}
?>
