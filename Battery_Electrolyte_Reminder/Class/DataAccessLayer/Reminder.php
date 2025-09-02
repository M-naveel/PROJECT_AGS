<?php 
// alert will store all the messages like an array to display the messages for the overdues or dues batteries
$alerts = []; // store alert messages

// Logic to calculate the check the current date from the sale date 
// the floor is used to roundsdown the value like 1.7 to 1
if ($result->num_rows > 0): 
    while($row = $result->fetch_assoc()):
        $todayTs = strtotime(date('Y-m-d'));
        $saleTs  = strtotime($row['Sale_Date']);
        $daysSinceSale = max(0, floor(($todayTs - $saleTs) / 86400));

        // Status logic
        // it will check the status that how many days have been passed since the battery is sold
        if ($daysSinceSale < 15) {
            $statusText  = 'Upcoming';
            $statusClass = 'text-success fw-bold';
        } elseif ($daysSinceSale % 15 === 0) {
            $statusText  = 'Due Today';
            $statusClass = 'text-warning fw-bold';
            $alerts[] = "Battery for {$row['Customer_Name']} (Model: {$row['Model_Name']}) is due today!";
        } else {
            $statusText  = 'Overdue';
            $statusClass = 'text-danger fw-bold';
            $alerts[] = "Battery for {$row['Customer_Name']} (Model: {$row['Model_Name']}) is overdue!";
        }
    ?>