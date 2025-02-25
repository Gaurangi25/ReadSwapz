<?php

require_once __DIR__ . '/../models/user.php';

class UserController {
    private $userModel;

    public function __construct($con) {
        $this->userModel = new User($con);

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

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        
        // Check if the user exists
        $res=$this->userModel->findByEmail($email);
        if (mysqli_num_rows($res)> 0) {
            echo ($count);
            mysqli_free_result($res);
            return "An account with this email already exists.";
        }

        // Save the user
        if ($this->userModel->save($name, $email, $hashedPassword)) {
            return "Account created successfully.";
        } else {
            return "An error occurred while creating your account.";
        }
    }

    public function getUser($email) {
        $query = "SELECT id, name, email FROM users WHERE email = ?";
        $stmt = $this->userModel->conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_assoc() ?: null;
    }
    
}

?>

