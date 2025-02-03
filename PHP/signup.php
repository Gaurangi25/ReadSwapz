<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // Your database username
$password = "gaurangi"; // Your database password
$dbname = "readswapz"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    if ($password !== $confirm_password) {
        header("Location: ../Pages/signup.html?error=Passwords do not match");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        // Redirect to login page or dashboard after successful signup
        header("Location: ../Pages/login.html?success=Account created successfully");
    } else {
        header("Location: ../Pages/signup.html?error=User already exists or error occurred");
    }

    $stmt->close();
    $conn->close();
}
?>
