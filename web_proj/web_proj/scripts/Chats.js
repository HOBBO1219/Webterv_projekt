function fetchMessagesFromDatabase(username, sessionuser) {
    return new Promise(function (resolve, reject) {
        // Make an AJAX request to fetch comments from the database
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "fetch_chat.php?username=" + encodeURIComponent(username) + "&sessionuser=" + encodeURIComponent(sessionuser), true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Parse the response JSON
                var chats = JSON.parse(xhr.responseText);
                resolve(chats);
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

function updateMessagesTable(chats) {
    var messageTable = document.getElementById("messageTable");
    // Clear existing messages
    var tbody = messageTable.querySelector('tbody');
    tbody.innerHTML = '';
    // Add fetched messages to the table
    chats.forEach(function(chat) {
        var newRow = tbody.insertRow();
        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);
        cell1.textContent = chat.Sender;
        cell2.textContent = chat.Message_content;
        cell3.textContent = chat.Message_date;
    });
}

function fetchMessagesAndUpdateModal(username, sessionuser) {
    // Fetch comments from the database
    fetchMessagesFromDatabase(username, sessionuser)
        .then(function(chats) {
            console.log("Messages fetched successfully:", chats);
            // Update comments table in the modal
            updateMessagesTable(chats);
        })
        .catch(function(error) {
            console.error('Error fetching messagess:', error);
            // Optionally, handle the error here (e.g., show an error message to the user)
        });
}

function openModal(username, sessionuser) {
    var modal = document.getElementById("myModal");

    // Fetch comments and update modal
    fetchMessagesAndUpdateModal(username, sessionuser);

    // Show the modal
    modal.style.display = "block";
}

function addMessage(sender, receiver, message_content) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "save_message.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log("Message sent successfully.");
                fetchMessagesAndUpdateModal(receiver, sender);
            } else {
                console.error("Error sending message. Status code: " + xhr.status);
            }
        }
    };
    var params = "sender=" + encodeURIComponent(sender) + "&receiver=" + encodeURIComponent(receiver) + "&message_content=" + encodeURIComponent(message_content);
    xhr.send(params);
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