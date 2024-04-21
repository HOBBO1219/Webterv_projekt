<?php
global $conn;
session_start();
include 'db.php';

// Check if the request contains the necessary parameters
if (isset($_POST['commentID']) && isset($_POST['newLikes'])) {
    $commentID = $_POST['commentID'];
    $newLikes = $_POST['newLikes'];

    // Update the like count in the database
    $stmt = $conn->prepare("UPDATE comments SET Likes = ? WHERE CommentID = ?");
    $stmt->bind_param("ii", $newLikes, $commentID);
    $stmt->execute();

    // Check if the like count was updated successfully
    if ($stmt->affected_rows > 0) {
        echo "Like count updated successfully.";
    } else {
        echo "Error updating like count.";
    }
    // Close prepared statement (do not close database connection here)
    $stmt->close();
} else {
    echo "Error: Required parameters are missing.";
}