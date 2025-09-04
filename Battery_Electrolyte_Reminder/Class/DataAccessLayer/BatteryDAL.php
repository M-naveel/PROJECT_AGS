<?php
class BatteryDAL {
    private $conn;

    // public function __construct($conn) {
    //     $this->conn = $conn;
    // }

    public function getAllBatteries() {
        $sql = "SELECT * FROM battery WHERE is_deleted = 0";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function softDeleteBattery($id, $deletedBy) {
        $sql = "UPDATE battery 
                SET is_deleted = 1, Deleted_At = NOW(), Deleted_By = ? 
                WHERE Id = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $deletedBy, $id);
        $stmt->execute();

        
        return $affected > 0; // true if a row was updated
    }
    public function getActiveBatteries() {
        $sql = "SELECT Id, Model_Name 
                FROM battery 
                WHERE Status = 'active' AND is_deleted = 0";

        $result = $this->conn->query($sql);

        $batteries = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $batteries[] = $row;
            }
        }
        return $batteries;
    }

    // public function getBatteryById($id) {
    //     $stmt = $this->conn->prepare("SELECT * FROM battery WHERE Id=?");
    //     $stmt->bind_param("i", $id);
    //     $stmt->execute();
    //     return $stmt->get_result()->fetch_assoc();
    // }
      public function __construct() {
        // Initialize the database connection
        $this->conn = new mysqli("localhost", "root", "", "electrolyte_reminder");
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    // public function __construct() {
    //     // Initialize the database connection
    //     $this->conn = new mysqli("localhost", "root", "", "electrolyte_reminder");
    //     if ($this->conn->connect_error) {
    //         die("Connection failed: " . $this->conn->connect_error);
    //     }
    // }

    
    

    // Fetch a battery by ID (ignore deleted ones)
    public function getBatteryById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM battery WHERE Id=? AND is_deleted=0");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Update a battery record (Updated_At handled automatically)
    public function updateBattery($id, $data) {
        $stmt = $this->conn->prepare(
            "UPDATE battery 
             SET Model_Name=?, Warranty_No=?, Battery_Code=?, 
                 Updated_By=?, Updated_At=NOW() 
             WHERE Id=? AND is_deleted=0"
        );
        $stmt->bind_param(
            "ssssi",
            $data['Model_Name'],
            $data['Warranty_No'],
            $data['Battery_Code'],
            $data['Updated_By'],
            $id
        );
        $stmt->execute();
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
        $data['Updated_By'] // Usually from                                                                                                                                                         
    );
    return $stmt->execute();
}

}

?>
