// Get all accordion buttons
const accordions = document.querySelectorAll('.accordion');

// Loop through each accordion button and add a click event listener
accordions.forEach((accordion) => {
    accordion.addEventListener('click', function() {
        // Toggle the active class
        this.classList.toggle('active');
        
        // Get the panel that is next to the clicked accordion
        const panel = this.nextElementSibling;
        
        // If the panel is open, close it
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            // Otherwise, open it
            panel.style.display = "block";
        }
    });
});
