
USE  ReadSwapz;

DELIMITER $$

CREATE PROCEDURE find_rented_books(IN user_email VARCHAR(150))
BEGIN
    DECLARE user_id INT;
    SELECT id INTO user_id 
    FROM users 
    WHERE email = user_email;

    IF user_id IS NOT NULL THEN
        SELECT 
            r.book_id, 
            b.title, 
            b.author, 
            r.rent_date, 
            r.due_date, 
            r.status
        FROM 
            rent r
        INNER JOIN 
            books b ON r.book_id = b.id
        WHERE 
            r.renter_id = user_id
            AND r.status = 'rented';
    ELSE
        -- Return an empty result set if user_email is invalid
        SELECT 'No user found with the given email' AS error_message;
    END IF;
END$$

DELIMITER ;


DELIMITER $$

CREATE PROCEDURE find_lended_books(IN user_email VARCHAR(150))
BEGIN
    DECLARE user_id INT;

    SELECT id INTO user_id 
    FROM users 
    WHERE email = user_email;

    IF user_id IS NOT NULL THEN
        SELECT 
            r.book_id,
            b.title,
            b.author,
            r.rent_date,
            r.due_date,
            r.status
        FROM 
            rent r
        INNER JOIN 
            books b ON r.book_id = b.id
        WHERE 
            r.lender_id = user_id
            AND 
            r.status = 'rented';
    ELSE
        -- Return an empty result set if user_email is invalid
        SELECT 'No user found with the given email' AS error_message;
    END IF;
END$$

DELIMITER ;