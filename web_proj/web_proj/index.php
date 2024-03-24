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
    <a href="account.php">Fiók</a>
    <a href="login.php">Kijelentkezés</a>
</nav>

<div class="content-container">
    <h2 class="centered_header">Üdv, *felhasználónév*!</h2>
    <br><br>
    <p class="centered_p">Szeretnél nézegetni képeket, vagy esetleg bővíteni tárházunkat a sajátjaiddal?</p>
    <br><br>

    <button class="re_gomb" onclick="location.href = 'pictures.php';">Fényképek</button>
    <br>
    <button class="re_gomb" onclick="location.href = 'upload.php';">Feltöltés</button>
</div>
</body>
</html>
