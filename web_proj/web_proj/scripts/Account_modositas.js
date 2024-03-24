function modifyField(fieldId) {
    var field = document.getElementById(fieldId);
    var button = field.nextElementSibling.querySelector('.mod_gomb');

    if (field.contentEditable === 'false') {
        field.contentEditable = 'true';
        field.focus();
        button.textContent = 'Mentés';
        button.style.backgroundColor = '#28a745'; // Change button color
        button.onclick = function() { saveChanges(fieldId); }; // Change button action
    } else {
        saveChanges(fieldId); // Save changes if Enter key pressed
    }
}

function saveChanges(fieldId) {
    var field = document.getElementById(fieldId);
    var button = field.nextElementSibling.querySelector('.mod_gomb');
    field.contentEditable = 'false';
    button.textContent = 'Módosít';
    button.style.backgroundColor = ''; // Reset button color
    button.onclick = function() { modifyField(fieldId); }; // Restore original button action
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