function confirmDelete(imageSrc) {
    var result = confirm("Biztosan törölni szeretné ezt a képet?");
    if (result) {
        // Majd kell egy delete image code ide
        console.log("Image deleted:", imageSrc);
    }
}