<?php
session_start();
require "config.php";  // Include database connection file

// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "<script>alert('Email and Password are required!');</script>";
        exit;
    }

    // Check if user exists in the database
    $query = "SELECT * FROM USER WHERE EMAIL = '$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $user['PASSWORD'])) {
            // Store user data in session
            $_SESSION['name'] = $user['NAME'];
            $_SESSION['email'] = $user['EMAIL'];

            // Redirect to dashboard.php
            header('Location: /ReadSwapz/Pages/dashboard.html');
            exit;
        } else {
            echo "<script>alert('Invalid password');</script>";
        }
    } else {
        echo "<script>alert('No user found with this email');</script>";
    }
}

mysqli_close($con);
?>
