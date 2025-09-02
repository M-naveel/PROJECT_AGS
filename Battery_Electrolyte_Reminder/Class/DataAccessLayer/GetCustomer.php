<?php include __DIR__ . "/DatabaseCon.php";

$Sql = "SELECT 
            s.Id,
            s.Customer_Name,
            s.Phone_Number,
            s.Email,
            s.Sale_Date,
            b.Model_Name AS Battery_Name,
            s.Updated_At,
            s.Updated_By,
            s.Status
        FROM sale s
        JOIN battery b ON s.Battery_ID = b.id
        WHERE s.Status = 'active' AND s.is_deleted = 0";

$Add = $conn->query($Sql);

$row = [];
while ($arr = $Add->fetch_assoc()) {
    $row[] = $arr;
}
?>
