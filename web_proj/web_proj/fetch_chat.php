<?php
global $conn;
session_start();
include 'db.php';

if (isset($_GET['username']) && isset($_GET['sessionuser'])) {
    $uname = $_GET['username'];
    $sess = $_GET['sessionuser'];

    $sqlChats = "SELECT sender, message_content, sent_at FROM chat WHERE ((sender = ($uname)) AND (receiver = ($sess))) OR ((receiver = ($uname)) AND (sender = ($sess) ))";
    $result = $conn->query($sqlChats);

    // Fetch comments as an associative array
    $chats = [];
    while ($row = $result->fetch_assoc()) {
        $chats[] = $row;
    }

    // Send comments as JSON response
    echo json_encode($chats);
} else {
    echo "Error";
}

// Close database connection
$conn->close();

