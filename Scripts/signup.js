document.getElementById('signupForm').addEventListener('submit', function(event) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;

    if (password !== confirmPassword) {
        alert('Passwords do not match. Please try again.');
        event.preventDefault(); // Prevent the form from submitting if passwords don't match
    }
});
