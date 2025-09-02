<?php
include "DatabaseCon.php";

class EditBattery {
   private $conn;

    public function __construct() {
        // Initialize the database connection
        $this->conn = new mysqli("localhost", "root", "", "electrolyte_reminder");
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Fetch a battery by ID
    public function getBatteryById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM battery WHERE Id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Update a battery record
    public function updateBattery($id, $data) {
        $stmt = $this->conn->prepare(
            "UPDATE battery SET Model_Name=?, Warranty_No=?, Battery_Code=?, Sale_Date=?, Status=?, Updated_By=?, Updated_At=? WHERE Id=?"
        );
        $stmt->bind_param(
            "sssssssi",
            $data['Model_Name'],
            $data['Warranty_No'],
            $data['Battery_Code'],
            $data['Sale_Date'],
            $data['Status'],
            $data['Updated_By'],
            $data['Updated_At'],
            $id
        );
        $stmt->execute();
    }
}
?>