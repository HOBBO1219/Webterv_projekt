<?php
session_start();
global $conn;
include 'db.php';

$loginStatus = '';
// Process login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['felnev'];
    $password = $_POST['jelszo'];

    $sql = "SELECT UserId, Username, Password, Email FROM users WHERE Username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['Password'])) {

            // Set session variables
            $_SESSION['felh_id'] = $row['UserId'];
            $_SESSION['username'] = $row['Username']; // Store the username
            $_SESSION['email'] = $row['Email'];

            // Redirect to fo_oldal.php
            header("Location: fo_oldal.php");
            exit();
        } else {
            $loginStatus = 'Invalid password!';
        }
    } else {
        $loginStatus = 'User not found!';
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

    <script>
        // Function to display login message in a popup
        function displayLoginMessage() {
            <?php
            // Check login status and display appropriate message
            if ($loginStatus === 'success') {
                echo "alert('Login successful!');";
            } elseif (!empty($loginStatus)) {
                echo "alert('$loginStatus');";
            }
            ?>
        }
    </script>

</head>
<body>
<h2>Bejelentkezés</h2>
<form action="login.php" method="post" onsubmit="return displayLoginMessage('Login successful!');">
    <label for="felnev">Felhasználónév:</label>
    <input type="text" id="felnev" name="felnev" required> <!-- Added id attribute -->
    <label for="jelszo">Jelszó:</label>
    <input type="password" id="jelszo" name="jelszo" required> <!-- Added id attribute -->
    <input type="submit" value="Bejelentkezés">
</form>
<p>Még nincs felhasználói fiókod? <a href="register.php">Regisztrálj itt!</a></p>


</body>
</html>
