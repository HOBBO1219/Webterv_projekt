<?php
global $conn;
session_start();
include 'db.php';

// Check if the request contains the necessary parameters
if (isset($_POST['sessionuser'], $_POST['username'], $_POST['message_content'])) {
    $sender = $_POST['sessionuser'];
    $receiver = $_POST['username'];
    $message_content = $_POST['message_content'];

    // Prepare the SQL statement
    $sql = "INSERT INTO chat (sender, receiver, message_content) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("sss", $sender, $receiver, $message_content);

    // Execute the statement
    if ($stmt->execute()) {
        // If the message is successfully saved, return a success response
        echo "Message saved successfully.";
    } else {
        // If an error occurs, return an error message
        echo "Error saving message.";
    }

    // Close the statement
    $stmt->close();
} else {
    // If any of the required parameters are missing, return an error message
    echo "Error: Required parameters missing.";
}

// Close the database connection
$conn->close();