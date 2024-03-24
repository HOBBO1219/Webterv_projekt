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
            <!-- Comments will be dynamically added here -->
        </table>
        <form id="commentForm" onsubmit="addComment(); return false;">
            <label for="commentText"></label><textarea id="commentText" placeholder="Enter your comment..." required></textarea>
            <button type="submit">Add Comment</button>
        </form>
    </div>
</div>

<script>
    function openModal(imageSrc) {
        var modal = document.getElementById("myModal");
        var modalImg = document.getElementById("modalImage");
        var commentsTable = document.getElementById("commentsTable");

        // Set the selected image source
        modalImg.src = imageSrc;

        // Populate comments table (replace with actual comments data)
        commentsTable.innerHTML = `
            <tr>
                <th>User</th>
                <th>Comment</th>
            </tr>
            <tr>
                <td>User1</td>
                <td>This picture is amazing, I mean just look at that cute dog. Love it. Life just got more exciting and relaxing at the same time. Congrats for this beautiful picture.</td>
            </tr>
            <tr>
                <td>User2</td>
                <td>Comment2</td>
            </tr>
            <tr>
                <td>User3</td>
                <td>Comment3</td>
            </tr>
            <tr>
                <td>User4</td>
                <td>Comment4</td>
            </tr>
            <tr>
                <td>User5</td>
                <td>Comment5</td>
            </tr>
            <tr>
                <td>User6</td>
                <td>Comment6</td>
            </tr>
            <tr>
                <td>User7</td>
                <td>Comment7</td>
            </tr>
            <tr>
                <td>User7</td>
                <td>Comment7</td>
            </tr>
            <tr>
                <td>User7</td>
                <td>Comment7</td>
            </tr>
            <tr>
                <td>User7</td>
                <td>Comment7</td>
            </tr>
            <tr>
                <td>User7</td>
                <td>Comment7</td>
            </tr>
            <tr>
                <td>User7</td>
                <td>Comment7</td>
            </tr>
            <tr>
                <td>User7</td>
                <td>Comment7</td>
            </tr>
            <tr>
                <td>User7</td>
                <td>Comment7</td>
            </tr>
            <tr>
                <td>User7</td>
                <td>MIVEL MEG NINCSEN HOZZAKOTVE ADATBAZIS, EZERT A HOZZAADOTT COMMENT MEG NEM MENTODIK EL SEHOL, EZERT HOGYHA KILEPUNK A COMMENT SZEKCIOBOL ES VISSZALEPUNK NEM LESZ OTT AZ UJ COMMENT.</td>
            </tr>
        `;

        modal.style.display = "block";
    }

    function closeModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }

    // Close modal when clicking outside the modal content
    window.onclick = function(event) {
        var modal = document.getElementById("myModal");
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }

    function addComment() {
        var commentText = document.getElementById("commentText").value;
        if (commentText.trim() === "") {
            alert("Please enter a comment.");
            return;
        }

        var commentsTable = document.getElementById("commentsTable");
        var newRow = commentsTable.insertRow(-1);
        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        cell1.textContent = "User"; // Replace with actual user
        cell2.textContent = commentText;

        document.getElementById("commentForm").reset(); // Clear the comment form

        // Scroll to the bottom of the comments table to show the new comment
        commentsTable.scrollTop = commentsTable.scrollHeight;

        // Optionally, you can save the comment to a database or perform any other necessary actions.
    }
</script>

</body>
</html>
