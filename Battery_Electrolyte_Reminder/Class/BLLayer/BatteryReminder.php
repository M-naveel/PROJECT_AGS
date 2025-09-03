<?php class BatteryReminder {
    public function getBatteryStatus($saleDate, $customerName, $modelName) {
        $todayTs = strtotime(date('Y-m-d'));
        $saleTs  = strtotime($saleDate);
        $daysSinceSale = max(0, floor(($todayTs - $saleTs) / 86400));

        if ($daysSinceSale < 15) {
            $statusText  = 'Upcoming';
            $statusClass = 'text-success fw-bold';
        } elseif ($daysSinceSale % 15 === 0) {
            $statusText  = 'Due Today';
            $statusClass = 'text-warning fw-bold';
            $alert = "Battery for {$customerName} (Model: {$modelName}) is due today!";
        } else {
            $statusText  = 'Overdue';
            $statusClass = 'text-danger fw-bold';
            $alert = "Battery for {$customerName} (Model: {$modelName}) is overdue!";
        }

        return [
            'statusText' => $statusText,
            'statusClass' => $statusClass,
            'daysSinceSale' => $daysSinceSale,
            'alert' => $alert ?? null
        ];
    }
}
?>