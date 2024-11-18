<?php
$servername = "localhost";
$username = "root";
$password = "gaurangi";
$dbname = "readswapz";

$con = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_connect_errno()) 
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
} 
else 
{
    echo "Connection made<br>";
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve form data
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
    }

    ECHO "HELLO";

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Create the `USER` table if it doesn't exist
    $table = "CREATE TABLE IF NOT EXISTS USER (
        NAME VARCHAR(30) NOT NULL,
        EMAIL VARCHAR(100) NOT NULL UNIQUE,
        PASSWORD VARCHAR(200) NOT NULL,
        CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if (mysqli_query($con, $table)) {
        echo "Table `USER` is ready.<br>";
    } else {
        die("Error creating table: " . mysqli_error($con));
    }

    // Insert user data into the table
    $insert = "INSERT INTO USER (NAME, EMAIL, PASSWORD) VALUES ('$name', '$email', '$hashed_password')";

    if (mysqli_query($con, $insert)) {
        echo "Registration successful!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

// Close the connection
mysqli_close($con);
