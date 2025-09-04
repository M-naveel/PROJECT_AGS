<?php 
class CustomerDAL {
    private $conn;

    // public function __construct($conn) {
    //     $this->conn = $conn;
    // }

    public function getAllCustomersfilter($filters = []) {
        $sql = "SELECT s.*, b.Model_Name FROM sale s 
                LEFT JOIN battery b ON s.Battery_ID=b.Id 
                WHERE s.is_deleted = 0";

        if (!empty($filters['customer'])) {
            $sql .= " AND s.sale LIKE '%" . $this->conn->real_escape_string($filters['customer']) . "%'";
        }
        if (!empty($filters['battery'])) {
            $sql .= " AND s.Battery_ID = " . intval($filters['battery']);
        }
        if (!empty($filters['start_date'])) {
            $sql .= " AND s.Sale_Date >= '" . $this->conn->real_escape_string($filters['start_date']) . "'";
        }
        if (!empty($filters['end_date'])) {
            $sql .= " AND s.Sale_Date <= '" . $this->conn->real_escape_string($filters['end_date']) . "'";
        }

        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
     
    
    public function getAllCustomers() {
 
    $sql = "
        SELECT 
            s.Id,
            s.Customer_Name,
            s.Phone_Number,
            s.Email,
            s.Sale_Date,
            b.Model_Name AS Battery_Name,
            s.Updated_At,
            s.Updated_By
        FROM sale s
        JOIN battery b ON s.Battery_ID = b.id
        WHERE s.Status = 'active' AND s.is_deleted = 0
    ";

    $result = $this->conn->query($sql);


    return $result->fetch_all(MYSQLI_ASSOC);
}

 public function softDeleteCustomer($id, $deletedBy) {
        $sql = "UPDATE sale
                SET is_deleted = 1, Deleted_At = NOW(), Deleted_By = ? 
                WHERE Id = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $deletedBy, $id);
        $stmt->execute();

        
        return $affected > 0; // true if a row was updated
    }
    


    // public function getCustomerById($id) {
    //     $stmt = $this->conn->prepare("SELECT * FROM sale WHERE Id=?");
    //     $stmt->bind_param("i", $id);
    //     $stmt->execute();
    //     return $stmt->get_result()->fetch_assoc();
    // }
    // private $conn;

     public function __construct() {
        // Initialize the database connection
        $this->conn = new mysqli("localhost", "root", "", "electrolyte_reminder");
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Fetch a customer by ID
    public function getCustomerById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM sale WHERE Id=? AND is_deleted=0");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function insertCustomer($data) {
        $stmt = $this->conn->prepare("
            INSERT INTO sale(Customer_Name, Phone_Number, Email, Battery_ID, Sale_Date, Updated_By, Updated_At)
            VALUES (?, ?, ?, ?, ?, ?, Now())
        ");

        $stmt->bind_param(
            "sssiss",
            $data['Customer_Name'],
            $data['Phone_Number'],
            $data['Email'],
            $data['Battery_ID'],
            $data['Sale_Date'],
            $data['Updated_By'],
        
        );

        return $stmt->execute();
    }
    // Fetch all batteries (for dropdown)
    public function getAllBatteries() {
        $result = $this->conn->query("SELECT * FROM battery WHERE is_deleted=0");
        $batteries = [];
        while ($row = $result->fetch_assoc()) {
            $batteries[] = $row;
        }
        return $batteries;
    }

    // Update customer record (without Status, Updated_At handled properly)
    public function updateCustomer($id, $data) {
        $stmt = $this->conn->prepare(
            "UPDATE sale 
             SET Customer_Name=?, Phone_Number=?, Email=?, Battery_ID=?, 
                 Updated_By=?, Updated_At=NOW(), Sale_Date=? 
             WHERE Id=? AND is_deleted=0"
        );
        $stmt->bind_param(
            "ssssssi",
            $data['Customer_Name'],
            $data['Phone_Number'],
            $data['Email'],
            $data['Battery_ID'],
            $data['Updated_By'],
            $data['Sale_Date'],
            $id
        );
        $stmt->execute();
    }

}
?>
