const textarea = document.getElementById('commentText');

// Automatically adjust the height of the textarea as the content grows
textarea.addEventListener('input', function() {
    this.style.height = 'auto';
    this.style.height = (this.scrollHeight) + 'px';
});