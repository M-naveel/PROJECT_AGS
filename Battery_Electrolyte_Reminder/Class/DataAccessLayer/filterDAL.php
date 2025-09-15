
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

       $sql = "SELECT 
    c.*, 
    b.Model_Name,
    b.Warranty_Period,

    -- Next reminder: based on last service date
    DATE_ADD(
        COALESCE(c.Last_Service_Date, c.Sale_Date), 
        INTERVAL (FLOOR(DATEDIFF(CURDATE(), COALESCE(c.Last_Service_Date, c.Sale_Date))/15)+1)*15 DAY
    ) AS Next_Reminder_Date,

    -- Warranty expiry: still from sale date
    DATE_ADD(c.Sale_Date, INTERVAL b.Warranty_Period MONTH) AS Warranty_Expiry_Date

FROM sale c
JOIN battery b ON c.Battery_ID = b.Id
WHERE $whereClause
ORDER BY c.created_at DESC;";
                 


        return $this->conn->query($sql);
    }

    function getDashboardStats(mysqli $conn): array {
    $stats = [];

    // Total batteries
    $stats['totalBatteries'] = $conn->query("SELECT COUNT(*) as total FROM battery where is_deleted = '0' ")
        ->fetch_assoc()['total'];

    // Battery health breakdown
    $stats['Dues'] = $conn->query(" SELECT COUNT(*) AS due_batteries
    FROM sale
    WHERE is_deleted ='0' AND DATEDIFF(
        CURDATE(), 
        COALESCE(Last_Service_Date, Sale_Date)
    ) > 15
")->fetch_assoc()['due_batteries'];
// count of reminder only for warranty battery
$stats['next'] = $conn->query("
    SELECT COUNT(*) AS upcoming_maintenances
    FROM (
        SELECT 
            DATE_ADD(
                COALESCE(s.Last_Service_Date, s.Sale_Date), 
                INTERVAL (FLOOR(DATEDIFF(CURDATE(), COALESCE(s.Last_Service_Date, s.Sale_Date)) / 15) + 1) * 15 DAY
            ) AS Next_Reminder_Date,

            DATE_ADD(s.Sale_Date, INTERVAL b.Warranty_Period MONTH) AS Warranty_Expiry_Date
        FROM sale s
        JOIN battery b ON s.Battery_ID = b.Id
        WHERE s.is_deleted = '0'
    ) AS t
    WHERE t.Next_Reminder_Date >= CURDATE()
      AND t.Warranty_Expiry_Date >= CURDATE()
")->fetch_assoc()['upcoming_maintenances'];

// 

    // $stats['batteryHealthModerate'] = $conn->query("SELECT COUNT(*) as total FROM battery WHERE health='Moderate'")
    //     ->fetch_assoc()['total'];
    // $stats['batteryHealthCritical'] = $conn->query("SELECT COUNT(*) as total FROM battery WHERE health='Critical'")
    //     ->fetch_assoc()['total'];

    // // Electrolyte alerts
    // $stats['electrolyteAlerts'] = $conn->query("SELECT COUNT(*) as total FROM battery WHERE electrolyte_due <= CURDATE()")
    //     ->fetch_assoc()['total'];

    // // Upcoming maintenance
    // $stats['upcomingMaintenance'] = $conn->query("SELECT COUNT(*) as total FROM maintenance WHERE date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)")
    //     ->fetch_assoc()['total'];

    // Customers
    $stats['customers'] = $conn->query("SELECT COUNT(*) as total FROM sale where is_deleted = '0' ")
        ->fetch_assoc()['total'];

    return $stats;
}

}
