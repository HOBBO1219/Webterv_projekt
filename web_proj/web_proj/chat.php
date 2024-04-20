<?php
session_start(); // Start the session
global $conn;
include 'db.php';
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="styles/main_style.css">

</head>
<body class="background_image">
<nav>
    <a href="fo_oldal.php">Főoldal</a>
    <a href="account.php" >Fiók</a>
    <a href="login.php">Kijelentkezés</a>
</nav>

<div class="content-container">
    <h2 class="centered_header">Kivel szeretnél chatelni?</h2>
    <br><br>

    // List of registered users
    <table>
        <?php
            $users = "SELECT username FROM users";
            $result = $conn->query($users);

            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['username'] ."</td></tr>";
            }
        ?>
    </table>

</div>
</body>
</html>
