const BACKEND_URL = "http://localhost/READSWAPZ/Backend/index.php"; // Replace with your backend URL

async function LoginUser() {
    const loggedInUser = localStorage.getItem('loggedInUser'); // Retrieve the data
    
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;

    try {
        // Send request to the backend
        console.log(`${BACKEND_URL}/user`);
        const response = await fetch(`${BACKEND_URL}/user/login`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email, password }),
        });
        const result = await response.json();
        console.log(result);

        if (response.ok) {
            alert(result.success || 'Account logged in successfully!');
            localStorage.setItem('loggedInUser', email);
            window.location.replace('./Pages/dashboard.html');
        } else {
            // On failure
            alert(result.error || 'An error occurred during login. Please try again.');
        }
    } catch (error) {
        // Handle network or server errors
        console.error('login Error:', error);
        alert('Failed to connect to the server. Please try again later.');
    }
}

// Function to handle logout
function logout() {
    localStorage.removeItem('loggedInUser'); // Clear the user's data
    alert('You have been logged out.');
    location.reload(); // Refresh the page
}

// Call the function to check login status on page load
document.getElementById('loginForm').addEventListener('submit', async function (event) {
    event.preventDefault(); 
    await LoginUser();
});
