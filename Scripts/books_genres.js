// Select buttons and set up event listeners for rent and buy buttons
const rentButtons = document.querySelectorAll('.rent-btn');
const buyButtons = document.querySelectorAll('.buy-btn');
const selectedBooksList = document.getElementById('selectedBooks');
const totalPriceSpan = document.getElementById('totalPrice');

let totalPrice = 0;

rentButtons.forEach(button => {
    button.addEventListener('click', () => {
        const bookTitle = button.getAttribute('data-title');
        const bookPrice = parseInt(button.getAttribute('data-price'));
        
        // Add book to the bill
        const li = document.createElement('li');
        li.textContent = `${bookTitle} - ₹${bookPrice}`;
        selectedBooksList.appendChild(li);

        // Update total price
        totalPrice += bookPrice;
        totalPriceSpan.textContent = totalPrice;
    });
});

buyButtons.forEach(button => {
    button.addEventListener('click', () => {
        const bookTitle = button.getAttribute('data-title');
        const bookPrice = parseInt(button.getAttribute('data-price'));
        
        // Add book to the bill
        const li = document.createElement('li');
        li.textContent = `${bookTitle} - ₹${bookPrice}`;
        selectedBooksList.appendChild(li);

        // Update total price
        totalPrice += bookPrice;
        totalPriceSpan.textContent = totalPrice;
    });
});
