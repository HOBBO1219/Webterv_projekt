<?php
global $conn;
session_start();
include 'db.php'; // Include your database connection file

if (isset($_SESSION['felh_id'])) {
    $userId = $_SESSION['felh_id'];

    // Retrieve picture file names associated with the user from the database
    $sql = "SELECT ImagePath FROM pictures WHERE UserId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Array to store picture file names
    $pictureFileNames = array();

    // Fetch picture file names
    while ($row = $result->fetch_assoc()) {
        $pictureFileNames[] = $row['ImagePath'];
    }

    // Close prepared statement
    $stmt->close();

    // Delete pictures from the picture directory
    foreach ($pictureFileNames as $fileName) {
        $filePath = 'pictures/' . $fileName;
        if (file_exists($filePath)) {
            unlink($filePath); // Delete the file
        }
    }

    // Prepare and execute SQL statement to delete user account
    $sqlDeleteUser = "DELETE FROM users WHERE UserId = ?";
    $stmtDeleteUser = $conn->prepare($sqlDeleteUser);
    $stmtDeleteUser->bind_param("i", $userId);
    $stmtDeleteUser->execute();

    // Check if deletion was successful
    if ($stmtDeleteUser->affected_rows > 0) {
        // Account deleted successfully
        session_destroy(); // Destroy the session
        header("Location: login.php"); // Redirect to login page
    } else {
        // Account deletion failed
        echo "Error: Account deletion failed.";
    }

    // Close prepared statement
    $stmtDeleteUser->close();
}

// Close database connection
$conn->close();