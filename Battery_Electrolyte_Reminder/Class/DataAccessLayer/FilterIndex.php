<?php 
$where = ["c.is_deleted = 0"];

// Customer filter
if (!empty($_GET['customer'])) {
    $customer = $conn->real_escape_string($_GET['customer']);
    $where[] = "c.Customer_Name LIKE '%$customer%'";
}

// Battery filter
if (!empty($_GET['battery'])) {
    $batteryId = (int) $_GET['battery'];
    $where[] = "c.Battery_ID = $batteryId";
}   

// Date range filter
if (!empty($_GET['start_date']) && !empty($_GET['end_date'])) {
    $startDate = $conn->real_escape_string($_GET['start_date']);
    $endDate   = $conn->real_escape_string($_GET['end_date']);
    $where[] = "DATE(c.Sale_Date) BETWEEN '$startDate' AND '$endDate'";
} elseif (!empty($_GET['start_date'])) {
    $startDate = $conn->real_escape_string($_GET['start_date']);
    $where[] = "DATE(c.Sale_Date) >= '$startDate'";
} elseif (!empty($_GET['end_date'])) {
    $endDate = $conn->real_escape_string($_GET['end_date']);
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

$result = $conn->query($sql);
?>
