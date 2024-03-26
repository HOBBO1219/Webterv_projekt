<?php
global $conn;
include 'db.php';


$registrationMessage = "";
// Process registration form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password


    // Check if passwords match
    $password_confirm = $_POST['password_confirm'];
    if ($_POST['password'] !== $password_confirm) {
        $registrationMessage = "Error: Passwords do not match.";
    } else {
        $sql = "INSERT INTO users (Email, Username, Password)
                VALUES ('$email', '$username', '$password')";

        if ($conn->query($sql) === TRUE) {
            $registrationMessage = "Registration successful!";
        } else {
            $registrationMessage = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();

session_start();

$_SESSION['registrationMessage'] = $registrationMessage;
?>



<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
    <link rel="stylesheet" href="styles/form_style.css">
    
</head>
<body>
    <h2>Regisztráció</h2>
    <form action="login.php" method="post">
        
        <label for="email" >E-mail cím:</label>
        <input type="text" name="email" id="email" required>

        <label for="felnev" >Felhasználónév:</label>
        <input type="text" name="felnev" id="felnev" required>
        
        <label for="jelszo" >Jelszó:</label>
        <input type="password" name="jelszo" id="jelszo" required>

        <label for="jelszo_ismet" >Jelszó megerősítése:</label>
        <input type="password" name="jelszo_ismet" id="jelszo_ismet" required>

        <input type="submit" value="Regisztrál">
    </form>
    <p>Már van fiókod? <a href="login.php">Jelentkezz be itt!</a></p>
</body>
</html>