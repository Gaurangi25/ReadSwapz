<?php
require_once "config/database.php";

$uri = strtok($_SERVER['REQUEST_URI'], '?');

switch ($uri) {
    case '/books':
        require "routes/bookRoutes.php";
        break;
    case '/rent':
        require "routes/rentRoutes.php";
        break;
    case '/user':
        require "routes/userRoutes.php";
        break;
    default:
        http_response_code(404);
        echo json_encode(["error" => "Route not found"]);
        break;
}
$conn->close();
?>
