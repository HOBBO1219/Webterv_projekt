<?php
global $conn;
include 'db.php';

// Process login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['Username'];
    $password = $_POST['Password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['Password'])) {
            echo "Login successful!";
            // Update last login time
            $conn->query("UPDATE users SET last_login=NOW() WHERE id=" . $row['id']);
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="styles/form_style.css">
</head>
<body>
<h2>Bejelentkezés</h2>
<form action="index.php" method="post">
    <label for="felnev">Felhasználónév:</label>
    <input type="text" id="felnev" name="felnev" required> <!-- Added id attribute -->
    <label for="jelszo">Jelszó:</label>
    <input type="password" id="jelszo" name="jelszo" required> <!-- Added id attribute -->
    <input type="submit" value="Bejelentkezés">
</form>
<p>Még nincs felhasználói fiókod? <a href="register.php">Regisztrálj itt!</a></p>
</body>
</html>
