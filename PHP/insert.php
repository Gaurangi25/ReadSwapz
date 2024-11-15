<?php
$servername = "localhost";
$username = "root";
$password = "gaurangi";
$dbname = "readswapz";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO users (username, email, password) VALUES ('TestUser', 'test@example.com', '" . password_hash("test123", PASSWORD_DEFAULT) . "')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
