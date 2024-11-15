// Get all accordion buttons
const acc = document.getElementsByClassName("accordion");

// Loop through each accordion button
for (let i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
        // Toggle the panel visibility
        this.classList.toggle("active");

        // Get the next sibling element (panel)
        const panel = this.nextElementSibling;

        // Toggle panel visibility
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}
