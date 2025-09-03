<?php
include __DIR__ . "/../DataAccessLayer/EditCustomer.php";

class CustomerBLL {
    private $dal;

    public function __construct($conn) {
        $this->dal = new EditCustomer($conn);
    }

    public function getCustomer($id) {
        return $this->dal->getCustomerById($id);
    }

    public function getAllBatteries() {
        return $this->dal->getAllBatteries();
    }

    public function updateCustomer($id, $data) {
        // Optional: add validation here if needed
        return $this->dal->updateCustomer($id, $data);
    }
}

$customerBLL = new CustomerBLL($conn);

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

    $customerBLL->updateCustomer($id, $data);
    header("Location: ../../Screen/Customer_Info_Record.php");
    exit;
}
?>
