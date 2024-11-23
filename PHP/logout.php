<?php
// Start the session
session_start();

echo "Hello";
// Destroy the session
session_unset();  // Unset all session variables
session_destroy(); // Destroy the session

// Redirect to login page
header("Location: login.php");
exit();
?>
