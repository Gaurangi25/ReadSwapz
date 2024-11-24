CREATE DATABASE ReadSwapz;
USE ReadSwapz;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    image BLOB ,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the `books` table
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    genre VARCHAR(100),
    publication_year INT,
    isbn VARCHAR(20) UNIQUE,
    available_copies INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE user_books (
    user_id INT,
    book_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE,
    PRIMARY KEY (user_id, book_id)  -- Composite primary key to ensure uniqueness of user-book pair
);

-- Create the `rent` table with renter and lender
CREATE TABLE rent (
    id INT AUTO_INCREMENT PRIMARY KEY,
    renter_id INT NOT NULL, -- User who rents the book
    lender_id INT NOT NULL, -- User who owns the book
    book_id INT NOT NULL,
    rent_date DATE NOT NULL,
    due_date DATE NOT NULL,
    return_date DATE,
    status ENUM('rented', 'returned', 'overdue') DEFAULT 'rented',
    FOREIGN KEY (renter_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (lender_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
);

-- Create the `genres` table (optional, for genre management)
CREATE TABLE genres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT
);

-- Create the `book_genres` table (many-to-many relationship between books and genres)
CREATE TABLE book_genres (
    book_id INT NOT NULL,
    genre_id INT NOT NULL,
    PRIMARY KEY (book_id, genre_id),
    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE,
    FOREIGN KEY (genre_id) REFERENCES genres(id) ON DELETE CASCADE
);

-- Create the `reviews` table (optional, for user reviews on books)
CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    book_id INT NOT NULL,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    review_text TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
);




