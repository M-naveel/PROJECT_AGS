<?php
// Start session to destroy it
session_start();
session_unset();   // Remove all session variables
session_destroy(); // Destroy the session
header("Location: signIn.php");
exit;
?>
