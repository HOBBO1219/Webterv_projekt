<?php
global $conn;
session_start();
include 'db.php';

// Retrieve user ID from session
$userID = $_SESSION['felh_id'];

// Retrieve images associated with the logged-in user
$sql = "SELECT * FROM pictures WHERE UserId = '$userID'";
$result = $conn->query($sql);

// Check if images are available
if ($result->num_rows > 0) {
    $images = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $images = []; // If no images found, initialize empty array
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pictures</title>
    <link rel="stylesheet" href="styles/main_style.css">
</head>
<body>
<nav>
    <a href="fo_oldal.php">Főoldal</a>
    <a href="login.php">Kijelentkezés</a>
</nav>

<h2 class="centered_header">Képgaléria</h2>

<div class="gallery-container">
    <?php
    $counter = 0;
    foreach ($images as $image):
        if ($counter % 3 === 0) {
            // Start a new row
            echo '<div class="gallery-row">';
        }
        ?>
        <img src="pictures/<?php echo htmlspecialchars($image['ImagePath']); ?>" alt="<?php echo htmlspecialchars($image['Description']); ?>" onclick="openModal('<?php echo htmlspecialchars($image['ImagePath']); ?>')">
        <?php
        $counter++;
        if ($counter % 3 === 0) {
            // Close the row
            echo '</div>';
        }
    endforeach;

    // Close the last row if the number of images is not divisible by 3
    if ($counter % 3 !== 0) {
        echo '</div>';
    }
    ?>
</div>

<!-- Modal -->
<div id="myModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <div class="modal-content">
        <img id="modalImage" src="" alt="Selected Image">
        <table id="commentsTable" class="commentsTable">
            <thead>
            <tr>
                <th>Username</th>
                <th>Comment</th>
                <th>Time</th>
            </tr>
            </thead>
            <tbody>
            <!-- Comments will be dynamically added here -->
            </tbody>
        </table>
        <form id="commentForm" onsubmit="addComment('<?php echo $image['ImagePath']; ?>'); return false;">
            <label for="commentText">Comment:</label>
            <textarea id="commentText" placeholder="Enter your comment..." required></textarea>
            <button type="submit">Add Comment</button>
        </form>
    </div>
</div>

<script src="scripts/Comments.js"></script>

</body>
</html>
