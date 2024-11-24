<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "READSWAPZ";
$con = mysqli_connect($servername, $username, $password, $dbname);

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

header("Content-Type: application/json");

$controller = new UserController($con); // Initialize the UserController

$method = $_SERVER['REQUEST_METHOD']; // Get the HTTP request method
//$method='GET';
switch ($method) {
    case 'POST': // Handle user registration
      $data = json_decode(file_get_contents("php://input"), true);

        if ($data) {
            // Debugging purpose (only use during development):
             //echo json_encode(["data" => $data]); 
             //return;
        }
        if (isset($data['name'], $data['email'], $data['password'], $data['confirm_password'])) {

            $response = $controller->signup($data);
            
            if ($response === "Account created successfully.") {
                echo json_encode(["success" => $response]);
                return;
            } else {
                http_response_code(400); // Bad Request
                echo json_encode(["error" => $response]);
                return;
            }
        } else {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Invalid input data"]);
        }
        break;

    case 'GET': // Fetch user data
        $userEmail = ($_GET['email']); 

        if (isset($_GET['email'])) {
            $userEmail = ($_GET['email']); 
            //$userEmail='a@a.com';
            $userQuery = "SELECT id, name , email FROM users WHERE email = '$userEmail'";
    
            $borrowedQuery = "SELECT * FROM find_rented_books($userEmail);";
            $donatedQuery = "SELECT * FROM find_lended_books($userEmail);";
            
            $userResult = mysqli_query($con, $userQuery);

            $count=mysqli_num_rows($userResult) ;

            if ($count > 0) {

                $user =mysqli_fetch_assoc($userResult);
                 
                // Fetch borrowed books
                $borrowedResult = $con->query($borrowedQuery);
                $borrowedBooks = [];
                $borrowedCount = 0;
                if ($borrowedResult && $borrowedResult->num_rows > 0) {
                    while ($row = $borrowedResult->fetch_assoc()) {
                        $borrowedBooks[] = $row;
                    }
                    $borrowedCount = count($borrowedBooks);
                    $user['borrowedCount'] = $borrowedCount;
                }
    
                // Fetch donated books
                $donatedResult = $con->query($donatedQuery);
                $donatedBooks = [];
                $donatedCount=0;
                if ($donatedResult && $donatedResult->num_rows > 0) {
                    while ($row = $donatedResult->fetch_assoc()) {
                        $donatedBooks[] = $row;
                    }
                    $donatedCount = count($donatedBooks);
                    $user['donatedCount'] = $donatedCount;
                }
    
                // Combine the data into a single response
                $response = [
                    "user" => $user,
                    "borrowed_books" => $borrowedBooks,
                    "donated_books" => $donatedBooks
                ];
    
                echo json_encode($response);
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

//$con->close(); // Close the database connection
?>
