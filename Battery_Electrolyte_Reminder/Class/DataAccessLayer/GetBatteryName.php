<?php 
include __DIR__ . "/DatabaseCon.php";

$Sql = "SELECT Id, Model_Name, Warranty_No, Battery_Code, Updated_At, Updated_By
        FROM battery 
        WHERE is_deleted = 0";

$Add = $conn->query($Sql);

// Initialize an array with name $batteries (not $battery)
$batteries = [];
while ($arr = $Add->fetch_assoc()) {
    $batteries[] = $arr;
}
?>
