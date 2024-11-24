const BACKEND_URL = "http://localhost/READSWAPZ/Backend/index.php"; // Replace with your backend URL


const loggedInUser = localStorage.getItem('loggedInUser'); // Retrieve the data

// Fetch user data
async function fetchUserDetails() {
    try {
        console.log(loggedInUser);

        const response = await fetch(`${BACKEND_URL}/user?email=${encodeURIComponent(loggedInUser)}`,{
            method: "GET",
            headers: {
                "Content-Type": "application/json",
            },
        });
        console.log("fetch completed");

        const userData = await response.json();
         
        if (userData.error) {
            console.error('Error fetching user data:', userData.error);
            alert('Unable to load user data. Please try again later.');
            return;
        }
         console.log (userData);
        // Update the DOM with user data
        document.getElementById('user-name').textContent = userData.user.name;
        document.getElementById('user-email').textContent = userData.user.email;
        document.getElementById('Borrowed').textContent = userData.user.borrowedCount;
        document.getElementById('Donated').textContent = userData.user.donatedCount;

    } catch (error) {
        console.error('Error fetching user details:', error);
        alert('Error fetching user details. Check console for details.');
    }
}

// Call the function on page load

if (loggedInUser) {
    // User is logged in
    console.log("logged in");
    fetchUserDetails();
} else {
    console.log("not logged in");

    // No user is logged in, redirect to login or show a message
    document.getElementById('user-name').textContent = "You are not loggedin !";

}
