<?php
global $conn;
session_start();
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['felh_id'])) {
    die("User not logged in.");
}

// Retrieve image source and rating from POST data
$imageSrc = $_POST['imageSrc'];
$rating = $_POST['rating'];

// Prepare and execute SQL query to save the rating
$sql = "INSERT INTO ratings (ImageSrc, Rating) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $imageSrc, $rating);
if ($stmt->execute()) {
    echo "Rating saved successfully.";
} else {
    echo "Error saving rating.";
}
$stmt->close();
$conn->close();