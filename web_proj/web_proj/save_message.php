<?php
global $conn;
session_start();
include 'db.php';

// Check if the request contains the necessary parameters
if (isset($_POST['sender']) && isset($_POST['receiver']) && isset($_POST['message_content'])) {
    $sender = $_POST['sender'];
    $receiver = $_POST['receiver'];
    $message_content = $_POST['message_content'];

    $sql = mysqli_query($conn, "INSERT INTO chat (sender, receiver, message_content) VALUES (?, ?, ?)");
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $sender, $receiver, $message_content, $sess);
    $stmt->execute();
    $result = $stmt->get_result();
}

$stmt->close();
$conn->close();
