<?php
global $conn;
include 'db.php';


$registrationMessage = "";
// Process registration form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username = $_POST['felnev'];
    $password = password_hash($_POST['jelszo'], PASSWORD_DEFAULT); // Hash the password


    // Check if passwords match
    $password_confirm = $_POST['jelszo_ismet'];
    if ($_POST['jelszo'] !== $password_confirm) {
        $registrationMessage = "HIBA: Helytelen jelszó.";
    } else {
        $sql = "INSERT INTO users (Email, Username, Password)
                VALUES ('$email', '$username', '$password')";

        if ($conn->query($sql) === TRUE) {
            $registrationMessage = "Regisztráció sikeres!";
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

    <script>
        // Function to display registration message in a popup
        function displayRegistrationMessage() {
            var registrationMessage = "<?php echo $registrationMessage; ?>";
            if (registrationMessage !== "") {
                alert(registrationMessage);
            }
        }

        // Call the function onload
        window.onload = displayRegistrationMessage;
    </script>
    
</head>
<body>
    <h2>Regisztráció</h2>
    <form action="register.php" method="post">
        
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