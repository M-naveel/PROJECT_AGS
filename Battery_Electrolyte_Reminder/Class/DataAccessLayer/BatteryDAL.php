<?php
class BatteryDAL {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllBatteries() {
        $sql = "SELECT * FROM battery WHERE is_deleted = 0";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getBatteryById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM battery WHERE Id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }


public function insertBattery($data) {
    $stmt = $this->conn->prepare(
        "INSERT INTO battery (Model_Name, Warranty_No, Status, Battery_Code, Updated_At, Updated_By) 
         VALUES (?, ?, ?, ?, NOW(), ?)"
    );
    $stmt->bind_param(
        "sssss",
        $data['Model_Name'],
        $data['Warranty_No'],
        $data['Status'],
        $data['Battery_Code'],
        $data['Updated_By'] // Usually from session
    );
    return $stmt->execute();
}
}

?>
