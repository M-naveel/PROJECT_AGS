
<?php
class FilterDAL {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getFilteredSales($filters) {
        $where = ["c.is_deleted = 0"];

        // Customer filter
        if (!empty($filters['customer'])) {
            $customer = $this->conn->real_escape_string($filters['customer']);
            $where[] = "c.Customer_Name LIKE '%$customer%'";
        }

        // Battery filter
        if (!empty($filters['battery'])) {
            $batteryId = (int) $filters['battery'];
            $where[] = "c.Battery_ID = $batteryId";
        }

        // Date range filter
        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $startDate = $this->conn->real_escape_string($filters['start_date']);
            $endDate   = $this->conn->real_escape_string($filters['end_date']);
            $where[] = "DATE(c.Sale_Date) BETWEEN '$startDate' AND '$endDate'";
        } elseif (!empty($filters['start_date'])) {
            $startDate = $this->conn->real_escape_string($filters['start_date']);
            $where[] = "DATE(c.Sale_Date) >= '$startDate'";
        } elseif (!empty($filters['end_date'])) {
            $endDate = $this->conn->real_escape_string($filters['end_date']);
            $where[] = "DATE(c.Sale_Date) <= '$endDate'";
        }

        $whereClause = implode(' AND ', $where);

        $sql = "SELECT c.*, b.Model_Name,
                DATE_ADD(
                    c.Sale_Date, 
                    INTERVAL (FLOOR(DATEDIFF(CURDATE(), c.Sale_Date)/15)+1)*15 DAY
                ) AS Next_Reminder_Date
                FROM sale c
                JOIN battery b ON c.Battery_ID = b.Id
                WHERE $whereClause
                ORDER BY c.Sale_Date DESC";

        return $this->conn->query($sql);
    }
}
