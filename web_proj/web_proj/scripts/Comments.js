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

function openModal(imageSrc) {
    var modal = document.getElementById("myModal");
    var modalImg = document.getElementById("modalImage");
    var commentsTable = document.getElementById("commentsTable");


    // Concatenate "pictures/" with the image source
    modalImg.src = "pictures/" + imageSrc;

    // Fetch comments from the database
    fetchCommentsFromDatabase(imageSrc)
        .then(function (comments) {
            console.log("Comments fetched successfully:", comments);

            // Clear existing comments
            var tbody = commentsTable.querySelector('tbody');
            tbody.innerHTML = '';

            // Add fetched comments to the table
            comments.forEach(function (comment) {
                var newRow = tbody.insertRow();
                var cell1 = newRow.insertCell(0);
                var cell2 = newRow.insertCell(1);
                var cell3 = newRow.insertCell(2);
                cell1.textContent = comment.Username;
                cell2.textContent = comment.Comment;
                cell3.textContent = comment.CommentedAt; // Assuming 'commentedAt' is the field name for the timestamp
            });

            // Show the modal
            modal.style.display = "block";
       })
        .catch(function (error) {
            console.error('Error fetching comments:', error);
            // Hide the modal if an error occurs
            modal.style.display = "none";
        });
}

function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
}

function addComment(imageSrc) {
    var commentText = document.getElementById("commentText").value;
    if (commentText.trim() === "") {
        alert("Please enter a comment.");
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "save_comment.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log("Comment added successfully: " + xhr.responseText);
                // Optionally, you can handle the response here
            } else {
                console.error("Error adding comment. Status code: " + xhr.status);
                // Optionally, handle the error here (e.g., show an error message to the user)
            }
        }
    };
    xhr.send("imageSrc=" + encodeURIComponent(imageSrc) + "&commentText=" + encodeURIComponent(commentText));
}

