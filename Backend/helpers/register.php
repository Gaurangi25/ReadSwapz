<?php
session_start();

require "config.php";


// Database connection
$con = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Ensure no fields are empty
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "<script>alert('All fields are required!');</script>";
        exit;
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.');</script>";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Create the `USER` table if it doesn't exist
    $table = "CREATE TABLE IF NOT EXISTS USER (
        NAME VARCHAR(30) NOT NULL,
        EMAIL VARCHAR(100) NOT NULL UNIQUE,
        PASSWORD VARCHAR(200) NOT NULL,
        CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if (!mysqli_query($con, $table)) {
        die("Error creating table: " . mysqli_error($con));
    }

    // Check if user already exists
    $check_user = "SELECT * FROM USER WHERE EMAIL = '$email'";
    $result = mysqli_query($con, $check_user);
    
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('An account with this email already exists.');</script>";
        exit;
    }

    // Insert user data into the table
    $insert = "INSERT INTO USER (NAME, EMAIL, PASSWORD) VALUES ('$name', '$email', '$hashed_password')";

    if (mysqli_query($con, $insert)) {
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;

        // Redirect to dashboard
        header('Location: http://localhost/ReadSwapz/PHP/dashboard.php');
        exit;
    } else {
        echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
    }
}

// Close the connection
mysqli_close($con);
?>
