<?php
include "../config.php";

function rentBook($renter_id, $lender_id, $book_id, $rent_date, $due_date) {
    global $conn;

    // Reduce available copies of the book
    $sql = "UPDATE books SET available_copies = available_copies - 1 WHERE id = '$book_id'";
    if ($conn->query($sql) === TRUE) {
        // Insert into rent table
        $sql = "INSERT INTO rent (renter_id, lender_id, book_id, rent_date, due_date, status) 
                VALUES ('$renter_id', '$lender_id', '$book_id', '$rent_date', '$due_date', 'rented')";

        if ($conn->query($sql) === TRUE) {
            return ["message" => "Book rented successfully!"];
        } else {
            return ["error" => $conn->error];
        }
    } else {
        return ["error" => "Could not update book availability."];
    }
}

function returnBook($rent_id) {
    global $conn;

    $sql = "UPDATE rent SET return_date = CURRENT_DATE, status = 'returned' WHERE id = '$rent_id'";

    if ($conn->query($sql) === TRUE) {
        // Increase the available copies of the book
        $sql = "SELECT book_id FROM rent WHERE id = '$rent_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $rent = $result->fetch_assoc();
            $book_id = $rent['book_id'];

            $sql = "UPDATE books SET available_copies = available_copies + 1 WHERE id = '$book_id'";

            if ($conn->query($sql) === TRUE) {
                return ["message" => "Book returned successfully!"];
            }
        }
    }

    return ["error" => "Could not return book."];
}
?>
