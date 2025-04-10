document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.getElementById('togglePassword');
    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
            const passwordField = document.getElementById('passwordField');
            if (!passwordField) return;
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                this.src = 'eye-open.jpg';
            } else {
                passwordField.type = 'password';
                this.src = 'eye-closed.png';
            }
        });
    }
});
