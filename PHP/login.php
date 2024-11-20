<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "gaurangi";
$dbname = "readswapz";

// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
    // Connection successful, proceed with login check
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = $_POST['password'];

        // Check if email and password are provided
        if (empty($email) || empty($password)) {
            echo "Email and Password are required!";
            exit;
        }

        // Check if user exists in the database
        $query = "SELECT * FROM USER WHERE EMAIL = '$email'";
        $result = mysqli_query($con, $query);
        
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            
            // Verify the password
            if (password_verify($password, $user['PASSWORD'])) {
                // Set session variables
                $_SESSION['name'] = $user['NAME'];
                $_SESSION['email'] = $user['EMAIL'];
                
                // Make sure no output is before this
                header('Location: ../PHP/dashboard.php');
                exit;
            } else {
                echo "<script>alert('Invalid password');</script>";
            }
        } else {
            echo "<script>alert('No user found with this email');</script>";
        }
    }
}

// Close the connection
mysqli_close($con);
?>
