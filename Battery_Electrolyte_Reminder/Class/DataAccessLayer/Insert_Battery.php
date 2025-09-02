<?php
include "DatabaseCon.php";

// Default values for soft-delete
$DeletedAt = null;
$DeletedBy = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Battery_Model = $_POST['Model_Name'];
    $Warranty_No   = $_POST['Warranty_No'];
    $Battery_Code  = $_POST['Battery_Code'];
    $UpdatedBy     = $_POST['Updated_By'];
    $UpdatedAt     = $_POST['Updated_At'];
    $Stat          = $_POST['Status'];
    $SaleDate      = $_POST['Sale_Date'];

    $Sql = "INSERT INTO battery 
        (Model_Name, Warranty_No, Battery_Code, Deleted_At, Deleted_By, Updated_At, Updated_By, Status, Sale_Date)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $Add = $conn->prepare($Sql);

    // 9 params → use s for string, i for int, d for double
    $Add->bind_param(
        "sssssssss",
        $Battery_Model,
        $Warranty_No,
        $Battery_Code,
        $DeletedAt,
        $DeletedBy,
        $UpdatedAt,
        $UpdatedBy,
        $Stat,
        $SaleDate
    );

    if ($Add->execute()) {
        echo "<script>alert('Data is inserted')</script>";
    } else {
        echo "Error: " . $Add->error;
    }

    $Add->close();
    $conn->close();
}
