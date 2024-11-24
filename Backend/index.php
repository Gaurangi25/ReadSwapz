<?php

include('./config/database.php');
include('./models/user.php');
include('./controllers/UserController.php');

//require "controllers/UserController.php"; 

// Handle CORS headers
header("Access-Control-Allow-Origin: *");  // Replace * with your frontend URL for security
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle preflight request for CORS
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit(0);
}

$base = "/READSWAPZ/Backend/index.php";
// Get the route from the URL
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace($base, '', $uri);

// Log the incoming request URI for debugging
error_log("Incoming Request URI: " . $_SERVER['REQUEST_URI']);

// Route handling
switch ($uri) {
    case '/books':
        require "/routes/bookRoutes.php"; // Handle book-related routes
        break;

    case '/rent':
        require "routes/rentRoutes.php"; // Handle rent-related routes
        break;

    case '/user':
        require "routes/userRoutes.php"; // Handle user signup/login
        break;

    case '/user/login' :
        require "routes/loginRoutes.php"; // Handle user signup/login
        break;
    default:
        // Return 404 for unknown routes
        http_response_code(404);
        echo json_encode(["error" => "Route not found"]);
        break;
}

// Close the database connection
$con->close();
?>
