<<<<<<< Updated upstream
// --- Handle Update (when form is submitted) ---
<?php
 include "DatabaseCon.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Id'])) {
    $Id = intval($_POST['Id']);
    $Model_Name = $_POST['Model_Name'];
    $Warranty = $_POST['Warranty'];
    $Battery_Code = $_POST['Battery_Code'];
    $SaleDate = $_POST['SaleDate'];

    $update_sql = "UPDATE battery 
                   SET Model_Name=?, Warranty=?, Battery_Code=?, SaleDate=?, Last_Updated_at=NOW() 
                   WHERE Id=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssssi", $Model_Name, $Warranty, $Battery_Code, $SaleDate, $Id);

    if ($stmt->execute()) {
        echo "<script>alert('Record Updated Successfully'); window.location.href='Record.php';</script>";
        exit;
    } else {
        echo "<script>alert('Update Failed');</script>";
    }
}

// --- Fetch Data for Editing (GET request) ---
if (isset($_GET['Id'])) {
    $Id = intval($_GET['Id']);

    $sql = "SELECT * FROM battery WHERE Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $Id);
    $stmt->execute();
    $result = $stmt->get_result();
    $battery = $result->fetch_assoc();

    if (!$battery) {
        die("Record not found.");
    }
} else {
    die("Invalid Request.");
=======
<?php
include "DatabaseCon.php";
class EditBattery {
   private $conn;

    public function __construct() {
        // Initialize the database connection
        $this->conn = new mysqli("localhost", "root", "", "electrolyte_reminder");
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Fetch a battery by ID
    public function getBatteryById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM battery WHERE Id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Update a battery record
    public function updateBattery($id, $data) {
        $stmt = $this->conn->prepare(
            "UPDATE battery SET Model_Name=?, Warranty_No=?, Battery_Code=?, Sale_Date=?, Status=?, Updated_By=?, Updated_At=? WHERE Id=?"
        );
        $stmt->bind_param(
            "sssssssi",
            $data['Model_Name'],
            $data['Warranty_No'],
            $data['Battery_Code'],
            $data['Sale_Date'],
            $data['Status'],
            $data['Updated_By'],
            $data['Updated_At'],
            $id
        );
        $stmt->execute();
    }
>>>>>>> Stashed changes
}
?>