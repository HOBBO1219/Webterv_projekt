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
        <a href="account.php">Fiók</a>
        <a href="login.php">Kijelentkezés</a>
    </nav>
    
    <h2 class="centered_header">Üdv, *felhasználónév*!</h2>
    <br><br>
    <p class="centered_p">Szeretnél nézegetni képeket, vagy esetleg bővíteni tárházunkat a sajátjaiddal?</p>
    <br><br>

    <button class="re_gomb" onclick="location.href = 'login.php';">Keresés</button>
    <br>
    <button class="re_gomb" onclick="location.href = 'upload.php';">Feltöltés</button>


</body>
</html>