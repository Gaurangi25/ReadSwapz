<?php
include "../config.php";

function addBook($title, $author, $genre, $available_copies) {
    global $conn;

    $sql = "INSERT INTO books (title, author, genre, available_copies) VALUES ('$title', '$author', '$genre', '$available_copies')";

    if ($conn->query($sql) === TRUE) {
        return ["message" => "Book added successfully!"];
    } else {
        return ["error" => $conn->error];
    }
}

function getBooks() {
    global $conn;

    $sql = "SELECT * FROM books";
    $result = $conn->query($sql);

    $books = [];
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }

    return $books;
}
?>
