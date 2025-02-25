// FAQ Toggle Script
document.addEventListener("DOMContentLoaded", () => {
    const accordionButtons = document.querySelectorAll(".accordion");

    accordionButtons.forEach((button) => {
        button.addEventListener("click", () => {
            // Toggle the active state for the accordion
            button.classList.toggle("active");

            // Get the associated panel
            const panel = button.nextElementSibling;

            // Smooth toggle of panel visibility
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    });
});
