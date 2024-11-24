//import BACKEND_URL from "./config";
const BACKEND_URL = "http://localhost/READSWAPZ/Backend/index.php"; // Replace with your backend URL

async function signupUser() {
    // Collect  values
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
     console.log("data saved in variables");
    // Validation
    if (!name || !email || !password || !confirmPassword) {
        alert('All fields are required. Please fill in the form completely.');
        return;
    }
    
    if (password !== confirmPassword) {
        alert('Passwords do not match. Please try again.');
        return;
    }
    console.log("password confirmed");


    try {
        // Send request to the backend
        console.log(`${BACKEND_URL}/user`);
        console.log("sending request");

        const response = await fetch(`${BACKEND_URL}/user`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ name, email, password, confirm_password: confirmPassword }),
        });
        console.log("request sended");

        const result = await response.json();
        console.log(result);

        if (response.ok) {
            // On success
            alert(result.success || 'Account created successfully!');
            // Save email to localStorage
            localStorage.setItem('loggedInUser', email);
            // Redirect to the dashboard
            window.location.href = './../dashboard.html';
        } else {
            // On failure
            alert(result.error || 'An error occurred during signup. Please try again.');
        }
    } catch (error) {
        // Handle network or server errors
        console.error('Signup Error:', error);
        alert('Failed to connect to the server. Please try again later.');
    }
}

// Attach event listener to the signup form
document.getElementById('signupForm').addEventListener('submit', async function (event) {
    event.preventDefault(); 
    await signupUser();
});


