<?php
session_start(); // Start the session
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Főoldal</title>
    <link rel="stylesheet" href="styles/main_style.css">

</head>
<body class="background_image">
<nav>
    <a href="account.php" >Fiók</a>
    <a href="chat.php">Üzenetek</a>
    <a href="login.php">Kijelentkezés</a>
</nav>

<div class="content-container">
    <h2 class="centered_header">Üdv, <?php echo $_SESSION['username']; ?>!</h2>
    <br><br>
    <p class="centered_p">Szeretnél nézegetni képeket, vagy esetleg bővíteni tárházunkat a sajátjaiddal?</p>
    <br><br>

    <!-- Pass user ID as a parameter in the URLs -->
    <button class="re_gomb" onclick="location.href = 'pictures.php?user_id=<?php echo $_SESSION['felh_id']; ?>';">Fényképek</button>
    <br>
    <button class="re_gomb" onclick="location.href = 'upload.php?user_id=<?php echo $_SESSION['felh_id']; ?>';">Feltöltés</button>
</div>
</body>
</html>
