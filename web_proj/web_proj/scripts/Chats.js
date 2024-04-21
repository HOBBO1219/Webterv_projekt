function fetchMessagesFromDatabase(username) {
    return new Promise(function (resolve, reject) {
        // Make an AJAX request to fetch comments from the database
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "fetch_comments.php?imageSrc=" + encodeURIComponent(username), true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Parse the response JSON
                var chat = JSON.parse(xhr.responseText);
                resolve(chat);
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

function fetchMessagesAndUpdateModal(username) {
    // Fetch comments from the database
    fetchMessagesFromDatabase(username)
        .then(function(chat) {
            console.log("Messages fetched successfully:", chat);
            // Update comments table in the modal
            updateMessagesTable(chat);
        })
        .catch(function(error) {
            console.error('Error fetching messagess:', error);
            // Optionally, handle the error here (e.g., show an error message to the user)
        });
}

function openModal(username) {
    var modal = document.getElementById("myModal");

    // Fetch comments and update modal
    fetchMessagesAndUpdateModal(username);

    // Show the modal
    modal.style.display = "block";
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