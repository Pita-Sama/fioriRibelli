document.querySelectorAll('.toggle-password').forEach(function(element) {
    element.addEventListener('click', function() {
        const targetId = this.getAttribute('data-target');
        const passwordField = document.getElementById(targetId);

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            this.src = 'eye-open.jpg';
        } else {
            passwordField.type = 'password';
            this.src = 'eye-closed.png';
        }
    });
});
