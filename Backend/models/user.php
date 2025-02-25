<?php
require_once(__DIR__ . '/../config/database.php');

class User {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

   
    public function findByEmail($email) {
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result= mysqli_query($this->con, $query);
        
        return $result;
    }


    public function save($name, $email, $hashedPassword) {
        $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";

       // Execute the query
        return mysqli_query($this->con, $query);
    }


    public function getUserById($id) {
        $query = "SELECT id, name, email FROM users WHERE id = $id";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

   
}
