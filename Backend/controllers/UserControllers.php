<?php

require_once __DIR__ . '/../models/user.php';

class UserController {
    private $userModel;

    public function __construct($dbConnection) {
        $this->userModel = new User($dbConnection);
    }

    public function signup($postData) {
        $name = htmlspecialchars($postData['name']);
        $email = htmlspecialchars($postData['email']);
        $password = $postData['password'];
        $confirmPassword = $postData['confirm_password'];

        // Validation
        if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
            return "All fields are required!";
        }

        if ($password !== $confirmPassword) {
            return "Passwords do not match.";
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Ensure the table exists
        if (!$this->userModel->createTable()) {
            return "Failed to create the USER table.";
        }

        // Check if the user exists
        if ($this->userModel->findByEmail($email)) {
            return "An account with this email already exists.";
        }

        // Save the user
        if ($this->userModel->save($name, $email, $hashedPassword)) {
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            header("Location: /dashboard.php");
            exit;
        } else {
            return "An error occurred while creating your account.";
        }
    }

    public function getUser($id) {
        $query = "SELECT id, name, email FROM users WHERE id = ?";
        $stmt = $this->userModel->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_assoc() ?: null;
    }
    
}

?>

<?php
session_start(); // Start the session to access session variables
include('db_connection.php'); // Include the database connection

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Get the logged-in user's ID

    // Query to fetch user data
    $sql = "SELECT name, email, books_borrowed, books_donated, books_available FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id); // Bind user ID to the query
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc(); // Fetch the user data
        echo json_encode($user_data); // Return user data as JSON
    } else {
        echo json_encode(['error' => 'User not found']);
    }
} else {
    echo json_encode(['error' => 'User not logged in']);
}

$conn->close(); // Close the database connection
?>
