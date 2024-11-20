<?php
session_start();

// Destroy the session to log out
session_destroy();

header('Location: http://localhost/ReadSwapz/Pages/login.html');
exit;
?>
