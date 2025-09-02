<?php
include "DatabaseCon.php"; // your DB connection

$sql = "SELECT c.*, b.Model_Name
        FROM sale c
        JOIN battery b ON c.Battery_ID = b.Id
        WHERE c.is_deleted = 0
          AND DATEDIFF(CURDATE(), c.Sale_Date) % 15 >= 0";

$result = $conn->query($sql);
?>
