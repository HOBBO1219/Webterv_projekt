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
        <a href="index.php">Főoldal</a>
        <a href="login.php">Kijelentkezés</a>
    </nav>    

    <h2 class="centered_header">Fiók módosítása</h2>
    <br><br>

    <table>
        <tr>
            <th>Felhasználónev:</th>
            <td>Asdef</td>
            <td class="mod_td"><button class="mod_gomb">Módosít</button></td>
        </tr>
        <tr>
            <th>E-mail:</th>
            <td>asdefg@gmail.com</td>
            <td class="mod_td"><button class="mod_gomb">Módosít</button></td>
        </tr>
    </table>

    <br><br><br>

    <table id="acc_del">
        <tr>
            <th>Fiók törlése</th>
            <td><button class="del_gomb">Töröl</button></td>
        </tr>
    </table>


</body>
</html>