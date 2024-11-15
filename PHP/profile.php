<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$query = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
$query->bind_param("i", $_SESSION['user_id']);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();
?>

<h1>User Profile</h1>
<p>Username: <?php echo $user['username']; ?></p>
<p>Email: <?php echo $user['email']; ?></p>
<a href="dashboard.php">Go back to Dashboard</a>
<a href="logout.php">Logout</a>
