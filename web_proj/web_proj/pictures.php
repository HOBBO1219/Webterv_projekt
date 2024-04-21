<?php
global $conn;
session_start();
include 'db.php';

// Function to fetch images from the database
function fetchImages() {
    global $conn;

    $sql = "SELECT * FROM pictures";
    $result = $conn->query($sql);

    // Check if images are available
    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return []; // If no images found, return empty array
    }
}

// Retrieve user ID from session
$userID = $_SESSION['felh_id'];

// Retrieve images associated with the logged-in user
$images = fetchImages();

// Calculate average rating for each image
foreach ($images as &$image) {
    $image['averageRating'] = calculateAverageRating($image['PictureID']); // Assuming 'PictureID' is the correct column name
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
    unset($image);
    foreach ($images as $image):
        if ($counter % 3 === 0) {
            // Start a new row
            echo '<div class="gallery-row">';
        }
        ?>
        <div class="image-container">
            <img src="pictures/<?php echo htmlspecialchars($image['ImagePath']); ?>" alt="<?php echo htmlspecialchars($image['Description']); ?>" onclick="openModal('<?php echo htmlspecialchars($image['ImagePath']); ?>', '<?php echo preg_replace('/\s+/', ' ', htmlspecialchars($image['Description'])); ?>')">
            <div class="rating">
                <?php
                // Display stars based on the average rating
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $image['averageRating']) {
                        echo '<span class="star">&#9733;</span>'; // Filled star
                    } else {
                        echo '<span class="star">&#9734;</span>'; // Empty star
                    }
                }
                ?>
            </div>
        </div>
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
        <div id="imageDescription"></div>
        <div id="starRating" class="star-rating">
            <span class="star" data-rating="1">&#9734;</span>
            <span class="star" data-rating="2">&#9734;</span>
            <span class="star" data-rating="3">&#9734;</span>
            <span class="star" data-rating="4">&#9734;</span>
            <span class="star" data-rating="5">&#9734;</span>
        </div>
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
        <form id="commentForm" onsubmit="addComment(); return false;">
            <label for="commentText">Comment:</label>
            <textarea id="commentText" placeholder="Enter your comment..." required></textarea>
            <input type="hidden" id="imageSrcInput" value="">
            <button type="submit">Add Comment</button>
        </form>
    </div>
</div>

<script src="scripts/Comments.js"></script>

</body>
</html>

<?php
// Define a function to calculate the average rating for a given image ID
function calculateAverageRating($imageID) {
    global $conn; // Assuming $conn is your database connection

    // Prepare and execute SQL query to calculate average rating
    $sql = "SELECT AVG(Rating) AS AverageRating FROM pictures WHERE PictureID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $imageID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the average rating
    $row = $result->fetch_assoc();
    $averageRating = $row['AverageRating'];

    // Return the average rating (round to 1 decimal place)
    return round($averageRating, 1);
}
?>
