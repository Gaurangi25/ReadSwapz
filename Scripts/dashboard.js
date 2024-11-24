// Function to display user information and statistics
function displayUserInfo() {
    // Getting elements by their IDs to insert dynamic data
    const userName = document.getElementById("user-name");
    const userEmail = document.getElementById("user-email");
    const booksBorrowed = document.getElementById("books-borrowed");
    const booksDonated = document.getElementById("books-donated");
    const booksAvailable = document.getElementById("books-available");

    // Setting the text content dynamically
    userName.textContent = `Hi, ${user.name}`;
    userEmail.textContent = `Email: ${user.email}`;
    booksBorrowed.textContent = `${user.booksBorrowed} / 20`;
    booksDonated.textContent = `${user.booksDonated} / 20`;
    booksAvailable.textContent = `${user.booksAvailable} / 20`;
}

// Call the function on page load
window.onload = displayUserInfo;
