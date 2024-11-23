document.addEventListener('DOMContentLoaded', function() {
    // Fetch user data from backend
    fetch('../backend/get_user_data.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error('Error:', data.error);
            } else {
                // Populate the profile with the fetched name and email
                document.getElementById('user-name').textContent = data.name;
                document.getElementById('user-email').textContent = data.email;
                document.getElementById('books-borrowed').textContent = data.books_borrowed;
                document.getElementById('books-donated').textContent = data.books_donated;
                document.getElementById('books-available').textContent = data.books_available;
            }
        })
        .catch(error => console.error('Error fetching data:', error));
});

document.getElementById('user-name').textContent = data.name;
document.getElementById('user-email').textContent = data.email;
