// Extract logged-in user's email from localStorage
function checkLogin() {
    const loggedInUser = localStorage.getItem('loggedInUser'); // Retrieve the data

    if (loggedInUser) {
        // User is logged in, display their email
        document.getElementById('welcome-message').textContent = `Welcome back, ${loggedInUser}!`;
    } else {
        // No user is logged in, redirect to login or show a message
        document.getElementById('welcome-message').textContent = 'You are not logged in.';
    }
}

// Function to handle logout
function logout() {
    localStorage.removeItem('loggedInUser'); // Clear the user's data
    alert('You have been logged out.');
    location.reload(); // Refresh the page
}

// Call the function to check login status on page load
checkLogin();
