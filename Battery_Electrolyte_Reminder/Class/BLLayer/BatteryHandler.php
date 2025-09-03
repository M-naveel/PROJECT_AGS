<?php
include __DIR__ . "/../DataAccessLayer/DatabaseCon.php";
include "BatteryBLL.php";

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

    if ($bll->addBattery($data)) {
        header("Location: ../../Screen/Record.php?success=1");
    } else {
        header("Location: ../../Screen/Battery_Form.php?error=1");
    }
}
?>
