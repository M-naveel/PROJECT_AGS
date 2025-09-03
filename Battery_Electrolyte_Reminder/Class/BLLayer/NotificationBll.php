<?php
include __DIR__ . "/../DataAccessLayer/NotificationDAL.php";

class NotificationBLL {
    private $dal;

    public function __construct() {
        $this->dal = new NotificationDAL();
    }

    public function checkBatteryStatus($customer) {
        $todayTs = strtotime(date('Y-m-d'));
        $saleTs  = strtotime($customer['Sale_Date']);
        $daysSinceSale = max(0, floor(($todayTs - $saleTs) / 86400));

        if ($daysSinceSale % 15 === 0) {
            $message = "Battery for {$customer['Customer_Name']} (Model: {$customer['Model_Name']}) is due today!";
            $this->dal->createNotification($customer['Id'], $message);
        } elseif ($daysSinceSale > 15) {
            $message = "Battery for {$customer['Customer_Name']} (Model: {$customer['Model_Name']}) is overdue!";
            $this->dal->createNotification($customer['Id'], $message);
        }
    }
}
?>
