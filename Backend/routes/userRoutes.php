<?php

require_once "../config/database.php"; // Include database configuration
require_once "../controllers/UserController.php"; // Include UserController

header("Content-Type: application/json");

$controller = new UserController($conn); // Initialize the UserController
$method = $_SERVER['REQUEST_METHOD']; // Get the HTTP request method

switch ($method) {
    case 'POST': // Handle user registration
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['name'], $data['email'], $data['password'], $data['confirm_password'])) {
            $response = $controller->signup($data);
            echo json_encode(["message" => $response]);
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(["error" => "Invalid input data"]);
        }
        break;

    case 'GET': // Fetch user data
        if (isset($_GET['id'])) {
            $userId = intval($_GET['id']);

            // Fetch user details using UserController (you'll implement a `getUser` method in the controller)
            $query = "SELECT id, name, email FROM users WHERE id = $userId";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                echo json_encode($user);
            } else {
                http_response_code(404); // Not Found
                echo json_encode(["error" => "User not found"]);
            }
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(["error" => "User ID not provided"]);
        }
        break;

    default:
        http_response_code(405); // Method Not Allowed
        echo json_encode(["error" => "Method not allowed"]);
        break;
}

$conn->close(); // Close the database connection
?>
