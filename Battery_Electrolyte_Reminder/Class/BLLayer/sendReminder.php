<?php
use PHPMailer\PHPMailer\PHPMailer;
session_start();
use PHPMailer\PHPMailer\Exception;
include __DIR__ . "/../DataAccessLayer/DatabaseCon.php";

require __DIR__ . "/../PHPMailermaster/src/Exception.php";
require __DIR__ . "/../PHPMailermaster/src/PHPMailer.php";
require __DIR__ . "/../PHPMailermaster/src/SMTP.php";
// require __DIR__ . "/../DatabaseCon.php"; // ✅ include DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer   = $_POST['customer'];   // customer name
    $to         = $_POST['email'];      // customer email
    $battery    = $_POST['battery'];    // battery name
    $customerId = $_POST['CustomerId']; // hidden field in form (actual ID)

    $subject = " Battery Maintenance Reminder";
    $message = "
        Dear $customer,

        This is a reminder that your battery ($battery) is due for maintenance.

        Please schedule maintenance at your earliest convenience.

        Regards,
        Battery Electrolyte Reminder System
    ";

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mnaveel051@gmail.com'; // your Gmail
        $mail->Password   = 'sluq gaav mnqy wkoz';  // Gmail app password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Email settings
        $mail->setFrom('mnaveel051@gmail.com', 'Battery System');
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        if ($mail->send()) {
            // it update the last date 
            $sql = "UPDATE sale SET Last_Service_Date = CURDATE() WHERE Id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $customerId);
            $status = "Sent ";
    $stmt->execute();
            echo "<script>
                    alert('✅ Email has been sent!');
                    window.location.href='/GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Index.php';
                  </script>";
        }
    } catch (Exception $e) {
        $status = "Failed ❌: " . $mail->ErrorInfo;
        echo "❌ Message could not be sent. Error: {$mail->ErrorInfo}";
    }

    // ✅ Save to email_logs table
    if (isset($status)) {
        $stmt = $conn->prepare("INSERT INTO email_logs 
            (CustomerID, CustomerName, Email, Subject, Status) 
            VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $customerId, $customer, $to, $subject, $status);
        $stmt->execute();
    }
}
?>
