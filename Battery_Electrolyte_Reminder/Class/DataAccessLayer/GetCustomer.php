<<<<<<< Updated upstream
<?php include "DatabaseCon.php";
   $Sql = "SELECT Id,Customer_Name,Phone_Number,Email,Sale_date,batteryids,Last_Updated_at,Last_Updated_By FROM sale WHERE Status_bar ='active'";

    $Add = $conn->query($Sql);


    // intialize an array with name row use a loop to get the value and then create a variabale that will take a value inside the loop parameter inside the loop give the values fetched from the database to the array done
    $row = [];
    while ($arr = $Add->fetch_assoc())
        {
            $row[] = $arr;
        }



=======
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
>>>>>>> Stashed changes
?>
