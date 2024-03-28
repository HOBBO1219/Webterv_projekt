<?php
global $conn;
session_start();
include 'db.php';

// Check if the request contains the necessary parameters
if (isset($_POST['imageSrc']) && isset($_POST['commentText'])) {
    $imageSrc = $_POST['imageSrc'];
    $commentText = $_POST['commentText'];

    // Retrieve the PictureId corresponding to the provided imageSrc
    $stmt = $conn->prepare("SELECT PictureId FROM pictures WHERE ImagePath = ?");
    $stmt->bind_param("s", $imageSrc);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the image exists in the database
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $pictureId = $row['PictureId'];

        // Insert the comment into the comments table
        $stmt = $conn->prepare("INSERT INTO comments (UserId, PictureId, Comment) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $_SESSION['felh_id'], $pictureId, $commentText);
        $stmt->execute();

        // Check if the comment was inserted successfully
        if ($stmt->affected_rows > 0) {
            echo "Comment saved successfully.";
        } else {
            echo "Error saving comment.";
        }
    } else {
        echo "Error: Image does not exist.";
    }
} else {
    echo "Error: Required parameters are missing.";
}

// Close prepared statement and database connection
$stmt->close();
$conn->close();
