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
    <form action="index.php" method="post">
        
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