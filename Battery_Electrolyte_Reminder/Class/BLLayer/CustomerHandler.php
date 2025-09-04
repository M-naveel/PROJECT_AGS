<?php
include __DIR__ . "/../DataAccessLayer/DatabaseCon.php";
include "customerBLL.php";
// session_start();
$editCustomer= new CustomerBLL($conn);


// // updating the customer
// $editCustomer = new CustomerBLL();

// Get customer ID from URL
if (!isset($_GET['Id'])) {
    die("No customer ID specified.");
}
$id = intval($_GET['Id']);

// Fetch customer and batteries
$Customer = $editCustomer->getCustomerById($id);
$batteries = $editCustomer->getAllBatteries();

// if (!$Customer) {
//     die("Customer not found.");
// }


session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['Id']);
    $data = [
        'Customer_Name' => $_POST['Customer_Name'],
        'Phone_Number'  => $_POST['Phone_Number'],
        'Email'         => $_POST['Email'],
        'Battery_ID'    => $_POST['Battery_ID'],
        'Sale_Date'     => $_POST['Sale_Date'],
        'Updated_By'    => $_SESSION['username'] ?? 'admin',
        'Updated_At'    => date('Y-m-d H:i:s')
    ];
    
    $editCustomer->updateCustomer($id, $data);
    header("Location: /GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Screen/customerInfoRecord.php");
    exit;
}

?>
