-- Step 4: Fetch Books Owned by a User
-- To fetch all books owned by a specific user, you can perform a join between user_books and books:

SELECT books.title, books.author, books.genre, books.publish_year 
FROM books
JOIN user_books ON books.id = user_books.book_id
WHERE user_books.user_id = 1;  -- Replace 1 with the user_id you want to query
-- This query will return all the books owned by the user with user_id = 1.

-- Step 5: Fetch All Users Who Own a Specific Book
-- To fetch all users who own a specific book, you can perform a similar query:

SELECT users.name, users.email 
FROM users
JOIN user_books ON users.id = user_books.user_id
WHERE user_books.book_id = 2;  -- Replace 2 with the book_id you want to query
-- This query will return all users who own the book with book_id = 2.

-- Step 6: Deleting Books from Users
-- If you want to delete a book from a user's collection, you can simply delete the row in the user_books table:

-- sql
-- Copy code
DELETE FROM user_books WHERE user_id = 1 AND book_id = 2;
--This will remove the association between User 1 and Book 2. The book itself will remain in the books table, but User 1 will no longer own it.