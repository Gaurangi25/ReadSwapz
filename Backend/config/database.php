<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "READSWAPZ";


// Database connection
$con = mysqli_connect($servername, $username, $password, $dbname);

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>