<?php

require "./config/database.php";

function setProfilePic($user_id, $file) {
    global $conn;

    // Check if a file is uploaded
    if (isset($file) && $file['error'] == 0) {
        // Get the file data
        $image_data = file_get_contents($file['tmp_name']); // Read the file into binary data
        
        // Prepare the SQL query to update the profile picture
        $stmt = $conn->prepare("UPDATE users SET image = ? WHERE id = ?");
        $stmt->bind_param("bi", $image_data, $user_id);  // 'b' for blob, 'i' for integer (user_id)
        
        // Execute the query
        if ($stmt->execute()) {
            echo "Profile picture updated successfully!";
        } else {
            echo "Error updating profile picture.";
        }
        $stmt->close();
    } else {
        echo "No file uploaded or file error.";
    }
}

// Check if the form is submitted and upload a new profile picture
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['profile_pic'])) {
    $user_id = 1;  // Replace with the actual user ID (e.g., from session or authentication)
    setProfilePic($user_id, $_FILES['profile_pic']);
}

// Close the database connection
$conn->close();
?>
