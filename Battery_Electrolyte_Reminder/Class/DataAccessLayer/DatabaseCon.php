<?php
 // XAMPP default
$username =  "root";
// Default MySQL username
$servername = "localhost";    

// Default is empty
$password   = "";           
 // Your database name
$database   = "electrolyte_reminder";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "You are connected";
// echo "<script> alert(`You are connected`)</script>";
?>
