<?php
class EditBattery {
    private $conn;

    public function __construct() {
        // Initialize the database connection
        $this->conn = new mysqli("localhost", "root", "", "electrolyte_reminder");
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

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
}
?>
