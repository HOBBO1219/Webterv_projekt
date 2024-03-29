<?php
session_start();
global $conn;
include 'db.php';

if (isset($_SESSION['felh_id'])) {
    $userId = $_SESSION['felh_id'];

    // Prepare SQL statement to fetch user information
    $sqlData = "SELECT Username, Email FROM users WHERE UserId = ?";
    $stmt = $conn->prepare($sqlData);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch user information
    if ($row = $result->fetch_assoc()) {
        $_SESSION['username'] = $row['Username']; // Store the username
        $_SESSION['email'] = $row['Email']; // Store the email
    } else {
        // User not found
        echo "Error: User not found.";
        exit();
    }


    // Prepare SQL statement to fetch images associated with the user
    $sqlImages = "SELECT ImagePath FROM pictures WHERE UserId = ?";
    $stmt = $conn->prepare($sqlImages);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch image names
    $imageNames = array();
    while ($row = $result->fetch_assoc()) {
        $imageNames[] = $row['ImagePath'];
    }

    // Close prepared statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>




<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Főoldal</title>
    <link rel="stylesheet" href="styles/main_style.css">
</head>
<body>

<nav>
    <a href="fo_oldal.php">Főoldal</a>
    <a href="login.php">Kijelentkezés</a>
</nav>

<h2 class="centered_header">Fiók módosítása</h2>
<br><br>

<table>
    <tr>
        <th>Felhasználónev:</th>
        <td id="username" contenteditable="false"><?php echo $_SESSION['username']; ?></td>
        <td><button class="mod_gomb" onclick="modifyField('username', <?php echo isset($_SESSION['felh_id']) ? $_SESSION['felh_id'] : 'null'; ?>)">Módosít</button></td>
    </tr>
    <tr>
        <th>E-mail:</th>
        <td id="email" contenteditable="false"><?php echo $_SESSION['email']; ?></td>
        <td><button class="mod_gomb" onclick="modifyField('email', <?php echo isset($_SESSION['felh_id']) ? $_SESSION['felh_id'] : 'null'; ?>)">Módosít</button></td>
    </tr>
</table>

<br><br><br>

<div class="del_gomb_container">
    <button class="del_gomb" onclick="deleteAccount()">Fiók törlése</button>
</div>

<div class="image-container">
    <?php
    // Loop through the image names and generate image tags
    foreach ($imageNames as $imageName) {
        echo '<img src="pictures/' . $imageName . '" alt="' . $imageName . '" ondblclick="confirmDelete(\'' . $imageName . '\')">';
    }
    ?>
</div>


<script src="scripts/Account_modositas.js"></script>
<script src="scripts/Delete_image.js"></script>

</body>
</html>
