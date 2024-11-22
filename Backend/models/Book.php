<?php

class Book {
    private $con;

    public function __construct($dbConnection) {
        $this->con = $dbConnection;
    }

    public function create($title, $author, $genre, $stock) {
        $query = "INSERT INTO books (title, author, genre, stock) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->con, $query);
        mysqli_stmt_bind_param($stmt, "sssi", $title, $author, $genre, $stock);
        return mysqli_stmt_execute($stmt);
    }

    public function listAll() {
        $query = "SELECT * FROM books";
        $result = mysqli_query($this->con, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function updateStock($bookId, $newStock) {
        $query = "UPDATE books SET stock = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->con, $query);
        mysqli_stmt_bind_param($stmt, "ii", $newStock, $bookId);
        return mysqli_stmt_execute($stmt);
    }
}
