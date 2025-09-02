<?php
// Start session to access $_SESSION variables
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../Battery_Electrolyte_Reminder/SignIn.php");
    exit;
}

// Define allowed pages for 'user' role
$user_allowed_pages = [

    'Add_Customer_Info.php',
    'userIndex.php',
    'Customer_Info_Record.php'
];

// Get current page filename
$current_page = basename($_SERVER['PHP_SELF']);

// If logged-in user is 'user' but page is not allowed, redirect to Unauthorized page
if ($_SESSION['role'] === 'user' && !in_array($current_page, $user_allowed_pages)) {
    header("Location: /GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Screen/Unauthorized.php");
    exit;
}
