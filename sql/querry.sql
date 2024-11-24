USE  ReadSwapz;

-- Inserting multiple genres

INSERT IGNORE INTO genres (name, description) VALUES
('Fiction', 'Literary works based on imaginative narration.'),
('Fantasy', 'Literary works with magical or supernatural elements.'),
('Mystery', 'Works that involve solving crimes or uncovering secrets.'),
('Romance', 'Stories focused on romantic relationships.'),
('Thriller', 'Books with high tension and suspenseful plots.'),
('Horror', 'Stories designed to scare and thrill the reader.'),
('Biography', 'Accounts of a person’s life written by someone else.'),
('Autobiography', 'Accounts of a person’s life written by themselves.'),
('History', 'Books detailing historical events and periods.'),
('Poetry', 'Works written in verse form to express emotions or ideas.'),
('Self-Help', 'Books providing advice for personal improvement.'),
('Philosophy', 'Works exploring fundamental questions about existence.'),
('Adventure', 'Stories centered around exciting journeys or events.'),
('Graphic Novels', 'Books told through a combination of art and text.'),
('Drama', 'Narratives dealing with emotional and relational themes.'),
('Comedy', 'Works designed to entertain and amuse readers.'),
('Young Adult', 'Books targeted at teenage audiences with relatable themes.'),
('Children', 'Stories and books for young readers.');


-- Inserting few books in table
INSERT INTO books (title, author, genre, publication_year, isbn, available_copies)
VALUES 
    ('To Kill a Mockingbird', 'Harper Lee', 'Fiction', 1960, '9780061120084', 5),
    ('1984', 'George Orwell', 'Dystopian', 1949, '9780451524935', 3),
    ('Pride and Prejudice', 'Jane Austen', 'Romance', 1813, '9781503290563', 4),
    ('The Great Gatsby', 'F. Scott Fitzgerald', 'Classic', 1925, '9780743273565', 2),
    ('Moby Dick', 'Herman Melville', 'Adventure', 1851, '9781503280786', 1),
    ('The Catcher in the Rye', 'J.D. Salinger', 'Fiction', 1951, '9780316769488', 3),
    ('Harry Potter and the Sorcerer  Stone', 'J.K. Rowling', 'Fantasy', 1997, '9780590353427', 7),
    ('The Lord of the Rings', 'J.R.R. Tolkien', 'Fantasy', 1954, '9780618640157', 6),
    ('The Alchemist', 'Paulo Coelho', 'Philosophical', 1988, '9780061122415', 4),
    ('The Hunger Games', 'Suzanne Collins', 'Science Fiction', 2008, '9780439023481', 5);
