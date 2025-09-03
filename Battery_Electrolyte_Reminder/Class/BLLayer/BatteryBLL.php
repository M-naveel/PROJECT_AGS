<?php
include __DIR__ . "/../DataAccessLayer/BatteryDAL.php";

class BatteryBLL {
    private $dal;

    public function __construct($conn) {
        $this->dal = new BatteryDAL($conn);
    }

    public function addBattery($data) {
        // You can add validation or business logic here if needed
        return $this->dal->insertBattery($data);
    }
}
?>
