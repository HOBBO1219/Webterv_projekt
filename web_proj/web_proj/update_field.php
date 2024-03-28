<?php
global $conn;
session_start();
include 'db.php';

if (isset($_POST['fieldId']) && isset($_POST['value']) && isset($_POST['userId'])) {
    $fieldId = $_POST['fieldId'];
    $value = $_POST['value'];
    $userId = $_POST['userId'];

    // Prepare SQL statement to update the specified field
    $sql = "";
    switch ($fieldId) {
        case "username":
            $sql = "UPDATE users SET Username = ? WHERE UserId = ?";
            break;
        case "email":
            $sql = "UPDATE users SET Email = ? WHERE UserId = ?";
            break;
        // Add cases for other fields if needed
        default:
            echo "Error: Invalid field ID.";
            exit();
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $value, $userId);

    // Execute the update query
    if ($stmt->execute()) {
        echo "Field updated successfully.";
    } else {
        echo "Error updating field: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Error: Invalid request.";
}
$conn->close();
