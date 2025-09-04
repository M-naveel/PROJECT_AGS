<?php
include __DIR__ . "/../DataAccessLayer/DatabaseCon.php";

include __DIR__ . "/../DataAccessLayer/customerDAL.php";

class CustomerBLL {
    private $dal;

    public function __construct($conn) {
        $this->dal = new CustomerDAL($conn);
    }

    public function getCustomerById($id) {
        return $this->dal->getCustomerById($id);
    }

    public function getAllBatteries() {
        return $this->dal->getAllBatteries();
    }

    public function updateCustomer($id, $data) {
        // Optional: add validation here if needed
        return $this->dal->updateCustomer($id, $data);
    }
     public function deleteCustomer($id,$deletedBy) {
        // You can add validation or business logic here if needed
        return $this->dal->softDeleteCustomer($id,$deletedBy);
    }
     public function addCustomer($data) {
        // Optional: add validation here if needed
        return $this->dal->insertCustomer( $data);
    }
}


?>
