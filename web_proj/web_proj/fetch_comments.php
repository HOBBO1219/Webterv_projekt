<?php
global $conn;
session_start();
include 'db.php';

if (isset($_GET['imageSrc'])) {
    $imageSrc = $_GET['imageSrc'];
    $sqlImagePath = "SELECT PictureId FROM pictures WHERE ImagePath = ?";


    // Prepare SQL statement to fetch comments associated with the selected image
    $sqlComments = "SELECT c.*, u.Username FROM comments c JOIN users u ON c.UserId = u.UserId WHERE c.PictureId = ($sqlImagePath)";
    $stmt = $conn->prepare($sqlComments);
    $stmt->bind_param("s", $imageSrc);
    $stmt->execute();
    $result = $stmt->get_result();


    // Fetch comments as an associative array
    $comments = [];
    while ($row = $result->fetch_assoc()) {
        $comments[] = $row;
    }

    // Send comments as JSON response
    echo json_encode($comments);
} else {
    // If imageSrc parameter is not provided, send an error message
    echo "Error: imageSrc parameter not provided.";
}

// Close prepared statement and database connection
$stmt->close();
$conn->close();
