window.onload = function() {
    adjustImageContainerHeight();
    fetchUserInfo();
};

function fetchUserInfo() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "account.php", true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var userInfo = JSON.parse(xhr.responseText);
            if (userInfo) {
                document.getElementById("username").textContent = userInfo.Username;
                document.getElementById("email").textContent = userInfo.Email;
                // Populate other fields as needed
            } else {
                console.error("Error: User information not found.");
            }
        } else {
            console.error("Error fetching user information. Status code: " + xhr.status);
        }
    };
    xhr.onerror = function() {
        console.error("Error fetching user information.");
    };
    xhr.send();
}


function modifyField(fieldId, userId) {
    var field = document.getElementById(fieldId);
    var button = field.nextElementSibling.querySelector('.mod_gomb');

    if (field.contentEditable === 'false') {
        field.contentEditable = 'true';
        field.focus();
        button.textContent = 'Mentés';
        button.style.backgroundColor = '#28a745'; // Change button color
        button.onclick = function() { saveChanges(fieldId, userId); }; // Change button action
    } else {
        saveChanges(fieldId, userId); // Save changes if Enter key pressed
    }
}



function saveChanges(fieldId, userId) {
    var field = document.getElementById(fieldId);
    var button = field.nextElementSibling.querySelector('.mod_gomb');
    var newValue = field.textContent.trim();

    field.contentEditable = 'false';
    button.textContent = 'Módosít';
    button.style.backgroundColor = ''; // Reset button color
    button.onclick = function() { modifyField(fieldId, userId); }; // Restore original button action

    // Send the updated value to the server
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update_field.php", true); // Change the URL to update_field.php
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log("Update successful: " + xhr.responseText);
                // Optionally, you can handle the response here
            } else {
                console.error("Error updating " + fieldId + ": " + xhr.status);
                // Optionally, handle the error here (e.g., show an error message to the user)
            }
        }
    };
    xhr.send("fieldId=" + encodeURIComponent(fieldId) + "&value=" + encodeURIComponent(newValue) + "&userId=" + userId);
}





window.onload = function() {
    adjustImageContainerHeight();
};

window.onresize = function() {
    adjustImageContainerHeight();
};

function adjustImageContainerHeight() {
    var windowHeight = window.innerHeight;
    var navHeight = document.querySelector('nav').offsetHeight;
    var headerHeight = document.querySelector('h2.centered_header').offsetHeight;
    var buttonContainerHeight = document.querySelector('.del_gomb_container').offsetHeight;
    var maxHeight = windowHeight - (navHeight + headerHeight + buttonContainerHeight + 250); // Adjust 100 as needed for additional spacing
    document.querySelector('.image-container').style.maxHeight = maxHeight + 'px';
}