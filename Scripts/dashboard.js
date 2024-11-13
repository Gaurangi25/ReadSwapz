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
    // Getting elements by their classes to insert dynamic data
    const userName = document.querySelector(".user-info h3");
    const userEmail = document.querySelector(".user-info p");
    const booksBorrowed = document.querySelector(".stats p:nth-child(1)");
    const booksDonated = document.querySelector(".stats p:nth-child(2)");
    const booksAvailable = document.querySelector(".stats p:nth-child(3)");

    // Setting the text content dynamically
    userName.textContent = `Hi, ${user.name}`;
    userEmail.textContent = `Email: ${user.email}`;
    booksBorrowed.textContent = `Books Borrowed: ${user.booksBorrowed}`;
    booksDonated.textContent = `Books Donated: ${user.booksDonated}`;
    booksAvailable.textContent = `Books Available: ${user.booksAvailable}`;
}

// Call the function on page load
window.onload = displayUserInfo;

// If you want to simulate changes, you can update this data and call displayUserInfo again.
