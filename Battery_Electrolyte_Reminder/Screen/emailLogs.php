<?php
session_start();
$pagename ="Email Logs";
$Heading ="Email Logs";

include __DIR__ . "/../navbar.php";
include __DIR__ . "/../Class/DataAccessLayer/DatabaseCon.php";
// DB connection
?>

<div class="container Adjust_screen mt-5" >
    <h2 class="mb-4 text-center" id="title">📧 Email Logs</h2>

    <table class="table table-bordered table-striped table-hove " id="DataTable">
        <thead class="table-dark">
            <tr>
                <th>Log ID</th>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Status</th>
                <th>Sent At</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT LogID, CustomerName, Email, Subject, Status, SentAt 
                    FROM email_logs 
                    ORDER BY SentAt DESC";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['LogID']}</td>
                        <td>{$row['CustomerName']}</td>
                        <td>{$row['Email']}</td>
                        <td>{$row['Subject']}</td>
                        <td>{$row['Status']}</td>
                        <td>{$row['SentAt']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>No logs found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<?php include "../footer.php"; ?>
