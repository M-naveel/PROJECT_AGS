<?php
// batteryAlerts.php
function getBatteryAlerts($conn, $reminderInterval = 15) {
    $alerts = [];
    $batteries = $conn->query("
        SELECT sale.*, battery.Model_Name
        FROM sale
        INNER JOIN battery ON sale.Battery_ID = battery.Id
        WHERE sale.is_deleted = 0
    ");

    if ($batteries && $batteries->num_rows > 0) {
        while ($row = $batteries->fetch_assoc()) {
            $todayTs = strtotime(date('Y-m-d'));
            $saleTs  = strtotime($row['Sale_Date']);
            $daysSinceSale = max(0, floor(($todayTs - $saleTs) / 86400));

            $nextReminderDays = ceil($daysSinceSale / $reminderInterval) * $reminderInterval;
            $daysUntilNextReminder = $nextReminderDays - $daysSinceSale;

            if ($daysUntilNextReminder > 0) {
                $statusText  = 'Upcoming';
                $statusBadge = 'success';
            } elseif ($daysUntilNextReminder === 0) {
                $statusText  = 'Due Today';
                $statusBadge = 'warning';
                $alerts[] = [
                    'message' => "Battery for {$row['Customer_Name']} (Model: {$row['Model_Name']}) is due today!",
                    'row' => $row,
                    'statusText' => $statusText,
                    'statusBadge' => $statusBadge,
                    'daysSinceSale' => $daysSinceSale
                ];
            } else {
                $statusText  = 'Overdue';
                $statusBadge = 'danger';
                $alerts[] = [
                    'message' => "Battery for {$row['Customer_Name']} (Model: {$row['Model_Name']}) is overdue!",
                    'row' => $row,
                    'statusText' => $statusText,
                    'statusBadge' => $statusBadge,
                    'daysSinceSale' => $daysSinceSale
                ];
            }
        }
    }
    return $alerts;
}
