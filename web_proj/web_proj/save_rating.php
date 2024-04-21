<?php
global $conn;
session_start();
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['felh_id'])) {
    die("User not logged in.");
}

// Retrieve user ID from session
$userID = $_SESSION['felh_id'];

// Retrieve image source and rating from POST data
$imageSrc = $_POST['imageSrc'];
$rating = $_POST['rating'];

// Check if the user has already rated the image
$sql = "SELECT * FROM ratings WHERE UserID = ? AND ImageSrc = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $userID, $imageSrc);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // If the user has already rated the image, update the existing rating
    $updateSql = "UPDATE ratings SET Rating = ? WHERE UserID = ? AND ImageSrc = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("iis", $rating, $userID, $imageSrc);
    if ($updateStmt->execute()) {
        echo "Rating updated successfully.";
    } else {
        echo "Error updating rating.";
    }
} else {
    // If the user has not rated the image before, insert a new rating
    $insertSql = "INSERT INTO ratings (UserID, ImageSrc, Rating) VALUES (?, ?, ?)";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param("isi", $userID, $imageSrc, $rating);
    if ($insertStmt->execute()) {
        echo "Rating saved successfully.";
    } else {
        echo "Error saving rating.";
    }
}

// Calculate average rating for the image source
$avgRatingSql = "SELECT AVG(Rating) AS AvgRating FROM ratings WHERE ImageSrc = ?";
$avgRatingStmt = $conn->prepare($avgRatingSql);
$avgRatingStmt->bind_param("s", $imageSrc);
$avgRatingStmt->execute();
$avgRatingResult = $avgRatingStmt->get_result();

if ($avgRatingResult->num_rows > 0) {
    $avgRow = $avgRatingResult->fetch_assoc();
    $avgRating = $avgRow['AvgRating'];
    // Update the average rating in the pictures table
    $updatePictureSql = "UPDATE pictures SET Rating = ? WHERE ImagePath = ?";
    $updatePictureStmt = $conn->prepare($updatePictureSql);
    $updatePictureStmt->bind_param("ds", $avgRating, $imageSrc);
    $updatePictureStmt->execute();
}

$stmt->close();
$avgRatingStmt->close();
$updateStmt->close();
$insertStmt->close();
$updatePictureStmt->close();
$conn->close();