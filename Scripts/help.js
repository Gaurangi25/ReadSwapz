document.getElementById('search-bar').addEventListener('input', function (e) {
    const query = e.target.value.toLowerCase();
    const faqItems = document.querySelectorAll('.faq-item, .faq-heading');

    // If the search query is empty, remove any highlights and return to original text
    if (query.trim() === "") {
        faqItems.forEach(item => {
            item.innerHTML = item.textContent; // Reset to original content
        });
    } else {
        // Otherwise, search and highlight matching text
        faqItems.forEach(item => {
            const itemText = item.textContent;
            const itemLower = itemText.toLowerCase();

            // Remove previous highlights by resetting the HTML content
            item.innerHTML = itemText;

            // Check if the search query matches part of the item text
            if (itemLower.includes(query)) {
                const startIdx = itemLower.indexOf(query);
                const endIdx = startIdx + query.length;

                // Wrap the matched text with <span> to highlight it
                const beforeMatch = itemText.slice(0, startIdx);
                const matchText = itemText.slice(startIdx, endIdx);
                const afterMatch = itemText.slice(endIdx);

                item.innerHTML = beforeMatch + `<span class="highlight">${matchText}</span>` + afterMatch;
            }
        });
    }
});


document.getElementById('clear-search').addEventListener('click', function() {
    document.getElementById('search-bar').value = '';  // Clear the input field
    document.querySelectorAll('.faq-item, .faq-heading').forEach(item => {
        item.innerHTML = item.textContent;  // Reset the items to original content
    });
});
