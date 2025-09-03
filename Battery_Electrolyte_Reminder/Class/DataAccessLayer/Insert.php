
<?php
include "DatabaseCon.php";


// Default values for soft delete
$DeletedAt = null;
$DeletedBy = null;
$is_deleted = 0;
$Status = 'active';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Customer_Name = $_POST['Customer_Name'];
    $Phone_Number  = $_POST['Phone_Number'];
    $Email         = $_POST['Email'];
    $Battery_ID    = $_POST['Battery_ID']; 
    /* comes from <select value="<?= $row['id'] ?>">*/
    $Updated_By    = $_SESSION['username'] ?? null;
    // $Updated_At    = $_POST['Updated_At'] ?? null;
    $Sale_Date     = $_POST['Sale_Date'] ?? null;
    

    $Sql = "INSERT INTO sale
        (Customer_Name, Phone_Number, Email, Battery_ID, Updated_By, Updated_At, Sale_Date, Status, Deleted_At, Deleted_By, is_deleted)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $Add = $conn->prepare($Sql);

    // bind_param type string:
    // s = string, i = integer, d = double, b = blob
    $Add->bind_param(
        "sssissssssi",
        $Customer_Name,
        $Phone_Number,
        $Email,
        $Battery_ID,     // int
        $Updated_By,
        $Updated_At,
        $Sale_Date,
        $Status,
        $DeletedAt,
        $DeletedBy,
        $is_deleted      // int (0 by default)
    );

    if ($Add->execute()) {
        echo "<script>alert('Customer data inserted successfully')</script>";
    } else {
        echo "Error: " . $Add->error;
    }

    $Add->close();
    $conn->close();
}
?>
