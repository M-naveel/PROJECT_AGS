<?php
session_start();

include __DIR__ . "/../DataAccessLayer/DatabaseCon.php";
// include __DIR__ . "/../DataAccessLayer/BatteryDAL.php";
include __DIR__ . "/../BLLayer/batteryBLL.php";

$delete = new BatteryBLL($conn); // ✅ pass DB connection

if (isset($_GET['Id'])) {
    $id = intval($_GET['Id']);
    $deletedBy = $_SESSION['username'] ?? 'admin';

    $delete->deleteBattery($id, $deletedBy); // calls BLL -> DAL

    header("Location: /GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Screen/record.php");
    exit;
} else {
    echo "No battery ID specified.";
}
?>
