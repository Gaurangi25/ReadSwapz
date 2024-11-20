<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['name']) || !isset($_SESSION['email'])) {
    // Redirect to login page if not logged in
    header('Location: http://localhost/ReadSwapz/Pages/login.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ReadSwapz</title>
    <link rel="stylesheet" href="http://localhost/ReadSwapz/Styles/dashboard.css">
</head>
<body>
    <header>
        <nav>
            <a href="../index.html" class="logo">ReadSwapz</a>
            <div class="menu-toggle">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
            <ul class="nav-links">
                <li><a href="../index.html">Home</a></li>
                <li><a href="../Pages/faq.html">About</a></li>
                <li><a href="../Pages/contact.html">Contact</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="dashboard-box">
            <h2>Welcome to your Dashboard</h2>
            <div class="user-info">
                <!-- Display logged-in user's details -->
                <h3 id="user-name">Hi, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h3>
                <p id="user-email">Email: <?php echo htmlspecialchars($_SESSION['email']); ?></p>
            </div>

            <div class="actions">
                <h3>Actions:</h3>
                <ul>
                    <li><a href="my-books.html">My Books</a></li>
                    <li><a href="borrow-books.html">Borrow Books</a></li>
                    <li><a href="donate-books.html">Donate Books</a></li>
                    <li><a href="profile.html">Profile</a></li>
                </ul>
            </div>

            <div class="stats">
                <h3>Statistics:</h3>
                <p id="books-borrowed">Books Borrowed: 0</p>
                <p id="books-donated">Books Donated: 0</p>
                <p id="books-available">Books Available: 0</p>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 <strong>ReadSwapz</strong>. All Rights Reserved.</p>
        <p>Follow us on:
            <a href="#" aria-label="Visit us on Facebook">Facebook</a> |
            <a href="#" aria-label="Visit us on Twitter">Twitter</a> |
            <a href="#" aria-label="Visit us on Instagram">Instagram</a>
        </p>
    </footer>
    <script src="../Scripts/menu_toggle.js"></script>
</body>
</html>
