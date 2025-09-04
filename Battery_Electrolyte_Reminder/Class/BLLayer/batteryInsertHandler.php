<?php
include __DIR__ . "/batteryBLL.php";
// include __DIR__ . "/../DataAccessLayer/DatabaseCon.php";
// include __DIR__ . 
session_start(); // To get user info for Updated_By
$bll = new BatteryBLL($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'Model_Name'   => $_POST['Model_Name'],
        'Warranty_No'  => $_POST['Warranty_No'],
        'Status'       => $_POST['Status'],
        'Battery_Code' => $_POST['Battery_Code'],
        'Updated_By'   => $_SESSION['username'] ?? 'admin'
    ];

    $bll->addBattery($data);
        header("Location: /GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Screen/record.php");
    exit;


}
?>