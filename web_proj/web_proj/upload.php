<?php
session_start();
global $conn;
include 'db.php';

// Function to generate unique filename
function generateUniqueFilename($filename) {
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    return uniqid() . '.' . $extension;
}

// Check if file is selected
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $image_name = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];

    // Check if file is an image
    $image_info = getimagesize($image_tmp_name);
    if ($image_info === FALSE) {
        die("Error: File is not an image.");
    }

    // Check file size (max 5MB)
    $max_size = 5 * 1024 * 1024; // 5 MB in bytes
    if ($image_size > $max_size) {
        die("Error: File size exceeds 5MB limit.");
    }

    // Generate a unique filename
    $new_filename = generateUniqueFilename($image_name);

    // Move the uploaded file to the uploads directory
    $upload_dir = 'pictures/';
    $destination = $upload_dir . $new_filename;
    if (!move_uploaded_file($image_tmp_name, $destination)) {
        die("Error: Failed to move uploaded file.");
    }

    // Get other form data
    $description = $_POST['description'];

    // Get user ID from the form
    $user_id = $_POST['user_id'];

    // Insert data into database
    $sql = "INSERT INTO pictures (UserId, ImagePath, Description) VALUES ('$user_id', '$new_filename', '$description')";
    if ($conn->query($sql) === TRUE) {
        echo "Image uploaded successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error uploading image.";
}
?>



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
    <a href="fo_oldal.php">Főoldal</a>
    <a href="login.php">Kijelentkezés</a>
</nav>

<div class="container">
    <h1>Upload Image</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['felh_id']; ?>">
        <input type="file" name="image" accept="image/*" required>
        <label>
            <textarea name="description" placeholder="Enter description..." required></textarea>
        </label>
        <button class="submit_button" type="submit">Upload</button>
    </form>
</div>
</body>
</html>