<?php
global $conn;
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if imageSrc is provided in the POST request
    if (isset($_POST['imageSrc'])) {
        $imageSrc = $_POST['imageSrc'];

        // Prepare SQL statement to delete the image from the database
        $sql = "DELETE FROM pictures WHERE ImagePath = ? AND UserId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $imageSrc, $_SESSION['felh_id']);

        // Execute the statement
        if ($stmt->execute()) {
            // If deletion is successful, return success
            $upload_dir = 'pictures/';
            $file_path = $upload_dir . $imageSrc;
            if (file_exists($file_path)) {
                unlink($file_path); // Delete the file
            }
            echo "success";
        } else {
            // If deletion fails, return error message
            echo "error";
        }

        // Close statement
        $stmt->close();
    }
}
// Close database connection
$conn->close();
