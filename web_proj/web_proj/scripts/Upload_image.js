const uploadContainer = document.getElementById('uploadContainer');
const fileInput = document.getElementById('fileInput');
const fileInputLabel = document.getElementById('fileInputLabel');
const imagePreviewContainer = document.getElementById('imagePreviewContainer');
const imagePreview = document.getElementById('imagePreview');

uploadContainer.addEventListener('dragover', function(e) {
    e.preventDefault();
    this.classList.add('dragover');
});

uploadContainer.addEventListener('dragleave', function(e) {
    e.preventDefault();
    this.classList.remove('dragover');
});

uploadContainer.addEventListener('drop', function(e) {
    e.preventDefault();
    this.classList.remove('dragover');
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        fileInput.files = files;
        showImagePreview(files[0]);
    }
});

fileInput.addEventListener('change', function() {
    if (this.files && this.files[0]) {
        showImagePreview(this.files[0]);
    }
});

function showImagePreview(file) {
    const reader = new FileReader();
    reader.onload = function(e) {
        imagePreview.src = e.target.result;
        imagePreviewContainer.style.display = 'block';
        fileInputLabel.textContent = 'Image Selected: ' + file.name;
    };
    reader.readAsDataURL(file);
}
