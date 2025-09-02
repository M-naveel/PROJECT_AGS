<?php
include "DatabaseCon.php";

// Handle deletion (POST request)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Id'])) {
    $delete_id = intval($_POST['Id']);
    $sql_delete = "UPDATE battery SET Status_bar = 'inactive' WHERE Id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $delete_id);
    $stmt_delete->execute();
    echo "<script>alert('Record deleted successfully!');</script>";
}

// // Fetch Data (GET request, listing active records)
// $sql_fetch = "SELECT * FROM battery WHERE Status_bar = 'active'";
// $result = $conn->query($sql_fetch);

// // Fetch single record if ID is provided
// $battery = null;
// if (isset($_GET['Id'])) {
//     $Id = intval($_GET['Id']);
//     $sql_single = "SELECT * FROM battery WHERE Id = ? AND Status_bar = 'active'";
//     $stmt_single = $conn->prepare($sql_single);
//     $stmt_single->bind_param("i", $Id);
//     $stmt_single->execute();
//     $result_single = $stmt_single->get_result();
//     $battery = $result_single->fetch_assoc();

//     if (!$battery) {
//         die("Record not found.");
//     }
// }
// ?>

