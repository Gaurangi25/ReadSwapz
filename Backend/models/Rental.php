<?php

class Rental {
    private $con;

    public function __construct($dbConnection) {
        $this->con = $dbConnection;
    }

    public function rentBook($userId, $bookId) {
        $query = "INSERT INTO rentals (user_id, book_id, rent_date) VALUES (?, ?, CURDATE())";
        $stmt = mysqli_prepare($this->con, $query);
        mysqli_stmt_bind_param($stmt, "ii", $userId, $bookId);
        return mysqli_stmt_execute($stmt);
    }

    public function returnBook($rentalId) {
        $query = "UPDATE rentals SET return_date = CURDATE(), status = 'returned' WHERE id = ?";
        $stmt = mysqli_prepare($this->con, $query);
        mysqli_stmt_bind_param($stmt, "i", $rentalId);
        return mysqli_stmt_execute($stmt);
    }

    public function getActiveRentals($userId) {
        $query = "SELECT * FROM rentals WHERE user_id = ? AND status = 'ongoing'";
        $stmt = mysqli_prepare($this->con, $query);
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
