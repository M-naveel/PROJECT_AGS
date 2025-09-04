<?php
include __DIR__ . "/../DataAccessLayer/batteryDAL.php";
include __DIR__ . "/../DataAccessLayer/DatabaseCon.php";

class BatteryBLL {
    private $dal;

    public function __construct($conn) {
        $this->dal = new BatteryDAL($conn);
    }

    public function addBattery($data) {
        // You can add validation or business logic here if needed
        return $this->dal->insertBattery($data);
    }
    public function updateBattery($id,$data) {
        // You can add validation or business logic here if needed
        return $this->dal->updateBattery($id,$data);
    }
     public function deleteBattery($id,$deletedBy) {
        // You can add validation or business logic here if needed
        return $this->dal->softDeleteBattery($id,$deletedBy);
    }
     public function getBatteryById($data) {
        // You can add validation or business logic here if needed
        return $this->dal->getBatteryById($data);
    }
}

?>
