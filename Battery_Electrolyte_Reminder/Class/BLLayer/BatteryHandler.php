<?php

// handles the edit page for the battery
// include __DIR__ . "/../DataAccessLayer/DatabaseCon.php";
include __DIR__. "/batteryBLL.php";
$editBattery = new BatteryBLL($conn);



// Get battery ID from URL
if (!isset($_GET['Id'])) {
    die("No battery ID specified.");
}
$id = intval($_GET['Id']);

// Fetch the battery record
$battery = $editBattery->getBatteryById($id);
if (!$battery) {
    die("Battery not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'Model_Name'   => $_POST['Model_Name'],
        'Warranty_No'  => $_POST['Warranty_No'],
        'Battery_Code' => $_POST['Battery_Code'],
        'Status'       => $_POST['Status'],
        'Updated_By'   => $_SESSION['username'],
        'Updated_At'   => date('Y-m-d H:i:s')
    ];
    
    // Update using the DAL
    $editBattery->updateBattery($id, $data);
    
    
    // Redirect to record list
    header("Location: record.php");
    exit;
}
?>
