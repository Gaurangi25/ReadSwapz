// Smooth scroll to the top when "Back to Top" button is clicked
document.getElementById('back-to-top').addEventListener('click', function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

// Highlight search terms in the FAQ section
document.getElementById('search-bar').addEventListener('input', function (e) {
    const query = e.target.value.toLowerCase();
    const faqItems = document.querySelectorAll('.faq-item, .faq-heading');

    faqItems.forEach(item => {
        // Store the original text as a data attribute (if not already stored)
        if (!item.dataset.originalText) {
            item.dataset.originalText = item.innerHTML; // Save the initial HTML content
        }

        const originalText = item.dataset.originalText;
        if (query.trim() === '') {
            // If the search query is empty, reset to original content
            item.innerHTML = originalText;
        } else {
            const lowerText = originalText.toLowerCase();
            // Highlight matches
            item.innerHTML = lowerText.includes(query)
                ? originalText.replace(new RegExp(query, 'gi'), match => `<span class="highlight">${match}</span>`)
                : originalText;
        }
    });
});

// Clear search and reset FAQ items
document.getElementById('clear-search').addEventListener('click', function () {
    document.getElementById('search-bar').value = ''; // Clear the input
    const faqItems = document.querySelectorAll('.faq-item, .faq-heading');

    faqItems.forEach(item => {
        // Reset content to the original text saved in the data attribute
        if (item.dataset.originalText) {
            item.innerHTML = item.dataset.originalText;
        }
    });
});
