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
    <a href="index.php">Főoldal</a>
    <a href="login.php">Kijelentkezés</a>
</nav>

<h2 class="centered_header">Képgaléria</h2>

<div class="gallery-container">
    <div class="gallery-row">
        <img src="image1.jpg" alt="Image 1" onclick="openModal('image1.jpg')">
        <img src="image2.jpg" alt="Image 2" onclick="openModal('image2.jpg')">
        <img src="image3.jpg" alt="Image 3" onclick="openModal('image3.jpg')">
    </div>
    <div class="gallery-row">
        <img src="image4.jpg" alt="Image 4" onclick="openModal('image4.jpg')">
        <img src="image5.jpg" alt="Image 5" onclick="openModal('image5.jpg')">
        <img src="image6.jpg" alt="Image 6" onclick="openModal('image6.jpg')">
    </div>
    <div class="gallery-row">
        <img src="image1.jpg" alt="Image 7" onclick="openModal('image7.jpg')">
        <img src="image3.jpg" alt="Image 8" onclick="openModal('image8.jpg')">
        <img src="image5.jpg" alt="Image 9" onclick="openModal('image9.jpg')">
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <div class="modal-content">
        <img id="modalImage" src="" alt="Selected Image">
        <table id="commentsTable" class="commentsTable">
            <!-- Commentek dinamikusan ide lesznek rakva a js-bol. -->
        </table>
        <form id="commentForm" onsubmit="addComment(); return false;">
            <label for="commentText"></label><textarea id="commentText" placeholder="Enter your comment..." required></textarea>
            <button type="submit">Add Comment</button>
        </form>
    </div>
</div>

<script src="Comments.js"></script>

</body>
</html>