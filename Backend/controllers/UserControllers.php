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
