<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
    <link rel="stylesheet" href="styles/main_style.css">
</head>
<body>
<nav>
    <a href="index.php">Főoldal</a>
    <a href="login.php">Kijelentkezés</a>
</nav>

<div class="container">
    <h1>Upload Image</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*" required>
        <textarea name="description" placeholder="Enter description..." required></textarea>
        <button class="submit_button" type="submit">Upload</button>
    </form>
</div>
</body>
</html>
