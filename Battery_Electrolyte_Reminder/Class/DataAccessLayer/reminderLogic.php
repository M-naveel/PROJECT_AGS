<?php $sql = "SELECT c.*, b.Model_Name,
        DATE_ADD(
            c.Sale_Date, 
            INTERVAL (FLOOR(DATEDIFF(CURDATE(), c.Sale_Date)/15)+1)*15 DAY
        ) AS Next_Reminder_Date,
        DATE_ADD(c.Sale_Date, INTERVAL c.Warranty_No MONTH) AS Warranty_Expiry_Date
        FROM sale c
        JOIN battery b ON c.Battery_ID = b.Id
        WHERE $whereClause
        ORDER BY c.updated_at DESC";
?>