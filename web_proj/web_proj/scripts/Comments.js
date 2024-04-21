function fetchCommentsFromDatabase(imageSrc) {
    return new Promise(function (resolve, reject) {
        // Make an AJAX request to fetch comments from the database
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "fetch_comments.php?imageSrc=" + encodeURIComponent(imageSrc), true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Parse the response JSON
                var comments = JSON.parse(xhr.responseText);
                resolve(comments);
            } else {
                reject('Request failed. Status: ' + xhr.status);
            }
        };
        xhr.onerror = function () {
            reject('Request failed');
        };
        xhr.send();
    });
}

function updateCommentsTable(comments) {
    var commentsTable = document.getElementById("commentsTable");
    // Clear existing comments
    var tbody = commentsTable.querySelector('tbody');
    tbody.innerHTML = '';
    // Add fetched comments to the table
    comments.forEach(function(comment) {
        var newRow = tbody.insertRow();
        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);
        cell1.textContent = comment.Username;
        cell2.textContent = comment.Comment;
        cell3.textContent = comment.CommentedAt; // Assuming 'commentedAt' is the field name for the timestamp
    });
}

function fetchCommentsAndUpdateModal(imageSrc) {
    // Fetch comments from the database
    fetchCommentsFromDatabase(imageSrc)
        .then(function(comments) {
            console.log("Comments fetched successfully:", comments);
            // Update comments table in the modal
            updateCommentsTable(comments);
        })
        .catch(function(error) {
            console.error('Error fetching comments:', error);
            // Optionally, handle the error here (e.g., show an error message to the user)
        });
}

function openModal(imageSrc, description) {
    var modal = document.getElementById("myModal");
    var modalImg = document.getElementById("modalImage");
    var imageDescription = document.getElementById("imageDescription");
    var imageSrcInput = document.getElementById("imageSrcInput"); // Get the hidden input field

    // Set the image source and description
    modalImg.src = "pictures/" + imageSrc;
    imageDescription.textContent = description;

    // Set the image source value in the hidden input field
    imageSrcInput.value = imageSrc;

    // Fetch comments and update modal
    fetchCommentsAndUpdateModal(imageSrc);

    // Show the modal
    modal.style.display = "block";
}


function addComment() {
    var commentText = document.getElementById("commentText").value;
    if (commentText.trim() === "") {
        alert("Please enter a comment.");
        return;
    }

    // Get the image source from the hidden input field
    var imageSrc = document.getElementById("imageSrcInput").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "save_comment.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log("Comment added successfully: " + xhr.responseText);
                // Clear the comment textbox
                document.getElementById("commentText").value = "";
                // Fetch and update comments without closing the modal
                fetchCommentsAndUpdateModal(imageSrc);
            } else {
                console.error("Error adding comment. Status code: " + xhr.status);
                // Optionally, handle the error here (e.g., show an error message to the user)
            }
        }
    };
    xhr.send("imageSrc=" + encodeURIComponent(imageSrc) + "&commentText=" + encodeURIComponent(commentText));
}

function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
}

document.addEventListener("keydown", function(event) {
    if (event.key === "Escape") {
        closeModal();
    }
});

window.addEventListener("click", function(event) {
    var modal = document.getElementById("myModal");
    if (event.target === modal) {
        closeModal(); // Close the modal if clicked outside of it
    }
});

// JavaScript for star rating
document.addEventListener("DOMContentLoaded", function () {
    var stars = document.querySelectorAll('.star-rating .star');

    stars.forEach(function (star) {
        star.addEventListener('mouseover', function () {
            var rating = parseInt(star.getAttribute('data-rating'));
            highlightStars(rating);
        });

        star.addEventListener('mouseout', function () {
            var rating = parseInt(document.querySelector('.star-rating .selected').getAttribute('data-rating'));
            highlightStars(rating);
        });

        star.addEventListener('click', function () {
            var rating = parseInt(star.getAttribute('data-rating'));
            saveRating(rating);
        });
    });

    function highlightStars(rating) {
        stars.forEach(function (star) {
            if (parseInt(star.getAttribute('data-rating')) <= rating) {
                star.innerHTML = '&#9733;'; // Filled star
            } else {
                star.innerHTML = '&#9734;'; // Empty star
            }
        });
    }

    function saveRating(rating) {
        var imageSrc = document.getElementById("imageSrcInput").value;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "save_rating.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log("Rating saved successfully: " + xhr.responseText);
                    fetchCommentsAndUpdateModal(imageSrc); // Update comments without closing the modal
                } else {
                    console.error("Error saving rating. Status code: " + xhr.status);
                    // Optionally, handle the error here (e.g., show an error message to the user)
                }
            }
        };
        xhr.send("imageSrc=" + encodeURIComponent(imageSrc) + "&rating=" + encodeURIComponent(rating));
    }
});
