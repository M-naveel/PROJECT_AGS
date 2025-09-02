<?php
class EditCustomer {
    private $conn;

    public function __construct() {
        // Database connection
        $this->conn = new mysqli("localhost", "root", "", "electrolyte_reminder");
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Fetch a customer by ID
    public function getCustomerById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM sale WHERE Id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Fetch all batteries (for dropdown)
    public function getAllBatteries() {
        $result = $this->conn->query("SELECT * FROM battery");
        $batteries = [];
        while ($row = $result->fetch_assoc()) {
            $batteries[] = $row;
        }
        return $batteries;
    }

    // Update customer record
    public function updateCustomer($id, $data) {
        $stmt = $this->conn->prepare(
            "UPDATE sale SET Customer_Name=?, Phone_Number=?, Email=?, Battery_ID=?, Updated_By=?, Updated_At=?, Sale_Date=?, Status=? WHERE Id=?"
        );
        $stmt->bind_param(
            "ssssssssi",
            $data['Customer_Name'],
            $data['Phone_Number'],
            $data['Email'],
            $data['Battery_ID'],
            $data['Updated_By'],
            $data['Updated_At'],
            $data['Sale_Date'],
            $data['Status'],
            $id
        );
        $stmt->execute();
    }
}
?>
