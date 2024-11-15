<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "gaurangi";
$dbname = "readswapz";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user from the database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Store user information in the session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];

            // Redirect to dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            header("Location: login.html?error=Invalid password");
        }
    } else {
        header("Location: login.html?error=No user found with this email");
    }

    $stmt->close();
    $conn->close();
}
?>
