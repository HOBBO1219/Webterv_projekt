function confirmDelete(imageSrc) {
    var result = confirm("Biztosan törölni szeretné ezt a képet?");
    if (result) {
        // Send an AJAX request to delete_image.php
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "delete_picture.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // If deletion is successful, remove the image from the DOM
                if (xhr.responseText === "success") {
                    var imgElement = document.querySelector('img[src="' + imageSrc + '"]');
                    if (imgElement) {
                        imgElement.parentNode.removeChild(imgElement);
                    }
                    location.reload();
                } else {
                    alert("Hiba történt a kép törlésekor.");
                }
            }
        };
        xhr.send("imageSrc=" + encodeURIComponent(imageSrc));
    }
}
