<?php
session_start();
include __DIR__ ."/./Class/DataAccessLayer/DatabaseCon.php"; // your DB connection
 // Your DB connection file

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['UserName']); // Sanitize input
    $password = trim($_POST['Password']); // Sanitize input

    // Query to fetch user record
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // If valid user found
    if ($row = $result->fetch_assoc()) {
        // Set session variables for authentication
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role']; // 'admin' or 'user'

        // Redirect based on role
        if ($row['role'] === 'admin') {
            header("Location: index.php");
        } else {
            header("Location: Screen/userIndex.php");
        }
        exit;
    } else {
        // Invalid login attempt
        echo "<script>alert('Invalid credentials'); window.location.href='signIn.php';</script>";
    }
}
?>
