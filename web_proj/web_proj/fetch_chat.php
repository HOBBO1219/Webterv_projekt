<?php
global $conn;
session_start();
include 'db.php';

if (isset($_GET['username']) && isset($_GET['sessionuser'])) {
    $uname = $_GET['username'];
    $sess = $_GET['sessionuser'];

    $sqlChats = "SELECT sender, message_content, sent_at FROM chat WHERE ((sender = ? AND receiver = ?) OR (receiver = ? AND sender = ?))";
    $stmt = $conn->prepare($sqlChats);
    $stmt->bind_param("ssss", $uname, $sess, $uname, $sess);
    $stmt->execute();
    $result = $stmt->get_result();


    // Fetch comments as an associative array
    $chats = [];
    while ($row = $result->fetch_assoc()) {
        $chat = array(
            "Sender" => $row['sender'],
            "MessageContent" => $row['message_content'],
            "MessageDate" => $row['sent_at']
        );
        $chats[] = $chat;
    }
    // Send comments as JSON response
    echo json_encode($chats);
} else {
    echo "Error";
}

// Close database connection
$conn->close();

