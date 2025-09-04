<?php
// For the insert page of customer
include __DIR__ . "/customerBLL.php";
include __DIR__ . "/../DataAccessLayer/DatabaseCon.php";

// include "DatabaseCon.php";


$Customer = new CustomerBLL($conn);

// Default values for soft delete
$DeletedAt = null;
$DeletedBy = null;
$is_deleted = 0;
$Status = 'active';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $data = [
        'Customer_Name' => $_POST['Customer_Name'],
        'Phone_Number'  => $_POST['Phone_Number'],
        'Email'         => $_POST['Email'],
        'Battery_ID'    => $_POST['Battery_ID'],
        'Sale_Date'     => $_POST['Sale_Date'],
        'Updated_By'    => $_SESSION['username'] ?? 'admin',
        'Updated_At'    => date('Y-m-d H:i:s')
    ];
  $Customer->addCustomer($data);
    header("Location: /GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Screen/customerInfoRecord.php");
    exit;
}

?>