// Dummy data for the user (this can be dynamically fetched from an API or stored data)
const user = {
    name: "Gaurangi Agarwal",
    email: "gaurangi250704@gamil.com",
    booksBorrowed: 5,
    booksDonated: 3,
    booksAvailable: 12
};

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
    booksBorrowed.textContent = `Books Borrowed: ${user.booksBorrowed}`;
    booksDonated.textContent = `Books Donated: ${user.booksDonated}`;
    booksAvailable.textContent = `Books Available: ${user.booksAvailable}`;
}

// Call the function on page load
window.onload = displayUserInfo;
