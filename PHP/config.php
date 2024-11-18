<?php

$servername = "localhost";
$username = "root";
$password = "gaurangi";
$dbname = "READSWAPZ";

$con = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
} else {
    echo "Connection made<br>";
}
mysqli_close($con);

?>
