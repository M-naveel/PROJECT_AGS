<?php
session_start();

// include __DIR__ . "/../DataAccessLayer/DatabaseCon.php";
include __DIR__ . "/../BLLayer/customerBLL.php";

$delete_Customer = new CustomerBLL($conn); 

if (isset($_GET['Id'])) {
    $id = intval($_GET['Id']);
    $deletedBy = $_SESSION['username'] ?? 'admin';

    $delete_Customer->deleteCustomer($id, $deletedBy); // calls BLL -> DAL

    header("Location: /GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Screen/customerInfoRecord.php");
    exit;
} else {
    echo "No battery ID specified.";
}
?>
