<?php include "DatabaseCon.php";
   $Sql = "SELECT Id,Customer_Name,Phone_Number,Email,Sale_date,batteryids,Last_Updated_at,Last_Updated_By FROM sale WHERE Status_bar ='active'";

$Add = $conn->query($Sql);


    // intialize an array with name row use a loop to get the value and then create a variabale that will take a value inside the loop parameter inside the loop give the values fetched from the database to the array done
    $row = [];
    while ($arr = $Add->fetch_assoc())
        {
            $row[] = $arr;
        }



?>
