<?php $where = ["c.is_deleted = 0"];

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

// Date filter
if (!empty($_GET['date'])) {
    $date = $conn->real_escape_string($_GET['date']);
    $where[] = "DATE(c.Sale_Date) = '$date'";
}

$whereClause = implode(' AND ', $where);

$sql = "SELECT c.*, b.Model_Name,
        DATE_ADD(c.Sale_Date, INTERVAL (FLOOR(DATEDIFF(CURDATE(), c.Sale_Date)/15)+1)*15 DAY) AS Next_Reminder_Date
        FROM sale c
        JOIN battery b ON c.Battery_ID = b.Id
        WHERE $whereClause
        ORDER BY c.Sale_Date DESC";
        $result = $conn->query($sql);
?>