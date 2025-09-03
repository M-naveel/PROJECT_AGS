<?php 
class CustomerDAL {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllCustomers($filters = []) {
        $sql = "SELECT s.*, b.Model_Name FROM sale s 
                LEFT JOIN battery b ON s.Battery_ID=b.Id 
                WHERE s.is_deleted = 0";

        if (!empty($filters['customer'])) {
            $sql .= " AND s.Customer_Name LIKE '%" . $this->conn->real_escape_string($filters['customer']) . "%'";
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

    public function getCustomerById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM sale WHERE Id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>
