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

$method = $_SERVER['REQUEST_METHOD'];
$method='POST';
switch ($method) {
    case 'POST': 

      $data = json_decode(file_get_contents("php://input"), true);
    
      if (isset($data['email'], $data['password'])) {

            $email= htmlspecialchars($data['email']);
            $pass=$data['password'];

            $query = "SELECT * FROM users WHERE email = '$email'";
            $result= mysqli_query($con, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result); // Fetch the user data
                $hashedPassword = $user['password']; // Get the stored hashed password
        
                // Verify the provided password against the hashed password
                if (password_verify($pass, $hashedPassword)) {
                    mysqli_free_result($result);
                    echo json_encode(["success" => "User logged in successfully"]);
                    return;
                } else {
                    http_response_code(401); // Unauthorized
                    echo json_encode(["error" => "Invalid password"]);
                    return;
                }    
            }else {
                http_response_code(400); // Bad Request
                echo json_encode(["error" => "User not found"]);
                return;
             }
        } else {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Invalid input data"]);
        }
        break;

    case 'GET': 
        
        break;
    
    default:
        http_response_code(405); // Method Not Allowed
        echo json_encode(["error" => "Method not allowed"]);
        break;

}













?>