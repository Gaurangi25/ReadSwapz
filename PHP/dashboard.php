<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];
$email = $_SESSION['email'];

// Example stats (Replace these with actual queries)
$books_borrowed = 5;
$books_donated = 2;
$books_available = 10;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ReadSwapz</title>
    <link rel="stylesheet" href="../Styles/dashboard.css">
</head>
<body>
    <header>
        <nav>
            <h1>
                <a href="../tempIndex.html" style="text-decoration: none; color: inherit; cursor: pointer;">
                    ReadSwapz
                </a>
            </h1>
            <ul>
                <li><a href="../tempIndex.html">Home</a></li>
                <li><a href="../Pages/aboutus.html">About us</a></li>
                <li><a href="../Pages/contact.html">Contact us</a></li>
                <li><a href="../Pages/help.html">Help</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="dashboard-box">
            <h2>Welcome to your Dashboard</h2>
            <div class="user-info">
                <h3>Hi, <?php echo htmlspecialchars($username); ?></h3>
                <p>Email: <?php echo htmlspecialchars($email); ?></p>
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
                <p>Books Borrowed: <?php echo $books_borrowed; ?></p>
                <p>Books Donated: <?php echo $books_donated; ?></p>
                <p>Books Available: <?php echo $books_available; ?></p>
            </div>
        </div>
    </div>

    <script src="../Scripts/dashboard.js"></script>
</body>
</html>
