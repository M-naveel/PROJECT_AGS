<?php
class NotificationDAL {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "electrolyte_reminder");
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Insert a notification
    public function createNotification($customerId, $message) {
        $stmt = $this->conn->prepare(
            "INSERT INTO notifications (Customer_Id, Message, Created_At) VALUES (?, ?, NOW())"
        );
        $stmt->bind_param("is", $customerId, $message);
        $stmt->execute();
    }
}
?>
