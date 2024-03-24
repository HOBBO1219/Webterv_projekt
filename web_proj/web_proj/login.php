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
