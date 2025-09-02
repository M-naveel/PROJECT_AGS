<?php
<<<<<<< Updated upstream
 include "DatabaseCon.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Id'])) {
    $Id = intval($_POST['Id']);
    $Customer_Name = $_POST['Customer_Name'];
    $Phone_Number = $_POST['Phone_Number'];
    $Email = $_POST['Email'];
    $SaleDate = $_POST['Sale_date'];
    $battery_id = $_POST['batteryids'];
    $Updated_at = $_POST['Last_Updated_at'];
    $Updated_By = $_POST['Last_Updated_By'];

    $update_sql = "UPDATE sale 
                   SET Customer_Name=?, Phone_Number =?, Email =?, Sale_date=?, batteryids=?, Last_Updated_at=NOW(), Last_Updated_By 
                   WHERE Id=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssssiss", $Customer_Name, $Phone_Number, $Email, $SaleDate, $battery_id,$Updated_at,$Updated_By);

    if ($stmt->execute()) {
        echo "<script>alert('Record Updated Successfully'); window.location.href='Customer_Info_Record.php';</script>";
        exit;
    } else {
        echo "<script>alert('Update Failed');</script>";
    }
}

// --- Fetch Data for Editing (GET request) ---
if (isset($_GET['Id'])) {
    $Id = intval($_GET['Id']);

    $sql = "SELECT * FROM sale WHERE Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $Id);
    $stmt->execute();
    $result = $stmt->get_result();
    $Customer = $result->fetch_assoc();

    if (!$Customer) {
        die("Record not found.");
    }
} else {
    die("Invalid Request.");
}
?>
=======
class EditCustomer {
    private $conn;

    public function __construct() {
        // Database connection
        $this->conn = new mysqli("localhost", "root", "", "electrolyte_reminder");
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Fetch a customer by ID
    public function getCustomerById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM sale WHERE Id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Fetch all batteries (for dropdown)
    public function getAllBatteries() {
        $result = $this->conn->query("SELECT * FROM battery");
        $batteries = [];
        while ($row = $result->fetch_assoc()) {
            $batteries[] = $row;
        }
        return $batteries;
    }

    // Update customer record
    public function updateCustomer($id, $data) {
        $stmt = $this->conn->prepare(
            "UPDATE sale SET Customer_Name=?, Phone_Number=?, Email=?, Battery_ID=?, Updated_By=?, Updated_At=?, Sale_Date=?, Status=? WHERE Id=?"
        );
        $stmt->bind_param(
            "ssssssssi",
            $data['Customer_Name'],
            $data['Phone_Number'],
            $data['Email'],
            $data['Battery_ID'],
            $data['Updated_By'],
            $data['Updated_At'],
            $data['Sale_Date'],
            $data['Status'],
            $id
        );
        $stmt->execute();
    }
}
?>
>>>>>>> Stashed changes
