<?php
// Start session to access $_SESSION variables
session_start();
$timeout_duration = 900;
// 900 seconds means 15 minutes if a user or admin stays 15 minutes inactive so the session will expire it and will redirect to the
// Login Page. 

if (isset($_SESSION['last_activity']) && 
    (time() - $_SESSION['last_activity']) > $timeout_duration) {
    
    // Last request was more than $timeout_duration ago
    session_unset();     // Remove session variables
    session_destroy();   // Destroy the session
    header("Location: /GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/signIn.php"); // Redirect to login page
    exit();
}

// Update last activity timestamp
$_SESSION['last_activity'] = time();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../Battery_Electrolyte_Reminder/signIn.php");
    exit;
}

// Define allowed pages for 'user' role
$user_allowed_pages = [

    'addCustomerInfo.php',
    'Index.php',
    'customerInfoRecord.php'
];

// Get current page filename
$current_page = basename($_SERVER['PHP_SELF']);

// If logged-in user is 'user' but page is not allowed, redirect to Unauthorized page
if ($_SESSION['role'] === 'user' && !in_array($current_page, $user_allowed_pages)) {
    header("Location: /GitHub/PROJECT_AGS/Battery_Electrolyte_Reminder/Screen/unauthorized.php");
    exit;
}
