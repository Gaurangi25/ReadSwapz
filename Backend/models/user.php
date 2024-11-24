<?php

class User
{
    private $con;

    public function __construct($dbConnection)
    {
        $this->con = $dbConnection;
    }

    public function createTable()
    {
        $table = "CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(150) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
         );";

        return mysqli_query($this->con, $table);
    }

    public function findByEmail($email)
    {
        $query = "SELECT * FROM USER WHERE EMAIL = ?";
        $stmt = mysqli_prepare($this->con, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    public function save($name, $email, $hashedPassword)
    {
        $query = "INSERT INTO USER (NAME, EMAIL, PASSWORD) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($this->con, $query);
        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPassword);
        return mysqli_stmt_execute($stmt);
    }
}
