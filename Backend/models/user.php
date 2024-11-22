<?php

class User {
    private $con;

    public function __construct($dbConnection) {
        $this->con = $dbConnection;
    }

    public function createTable() {
        $table = "CREATE TABLE IF NOT EXISTS USER (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            NAME VARCHAR(30) NOT NULL,
            EMAIL VARCHAR(100) NOT NULL UNIQUE,
            PASSWORD VARCHAR(200) NOT NULL,
            CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        return mysqli_query($this->con, $table);
    }

    public function findByEmail($email) {
        $query = "SELECT * FROM USER WHERE EMAIL = ?";
        $stmt = mysqli_prepare($this->con, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    public function save($name, $email, $hashedPassword) {
        $query = "INSERT INTO USER (NAME, EMAIL, PASSWORD) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($this->con, $query);
        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPassword);
        return mysqli_stmt_execute($stmt);
    }
}
