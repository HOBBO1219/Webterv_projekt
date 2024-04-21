<?php
global $conn;
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chats</title>
    <link rel="stylesheet" href="styles/main_style.css">
</head>
<body>
<nav>
    <a href="fo_oldal.php">Főoldal</a>
    <a href="login.php">Kijelentkezés</a>
</nav>

<h2 class="centered_header">Kivel szeretnél chatelni?</h2>

<table>
    <?php
        $user_list = "SELECT username FROM users";
        $result = $conn->query($user_list);
        while($row = $result->fetch_assoc()){
            echo "<tr><td>" . $row['username'] . "</td><td>";
            echo "<input type='submit' onclick='openModal(\"" . htmlspecialchars($row['username']) . "\")'>";
            echo "</td></tr>";


        }
    ?>
</table>

<!-- Modal -->

<div id="myModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <div class="modal-content">
        <table id="messageTable" class="messageTable">
            <thead>
            <tr>
                <th>Username</th>
                <th>Comment</th>
                <th>Time</th>
            </tr>
            </thead>
            <tbody>
            <!-- Messages will be dynamically added here -->

            </tbody>
        </table>
        <form id="messageForm" onsubmit="addMessage(); return false;">
            <label for="messageText">Message:</label>
            <textarea id="messageText" placeholder="Enter your message..." required></textarea>
            <input type="hidden" id="imageSrcInput" value="">
            <button type="submit">Send</button>
        </form>
    </div>
</div>

<script src="scripts/Chats.js"></script>

</body>
</html>
