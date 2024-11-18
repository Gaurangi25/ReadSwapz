window.addEventListener("load", function () {
  // Select preloader and content elements
  const preloader = document.getElementById("preloader");
  const content = document.getElementById("content");

  // Add a fade-out animation class to the preloader
  preloader.classList.add("fade-out");

  // Wait for the animation to complete before hiding the preloader
  preloader.addEventListener("transitionend", function () {
    preloader.style.display = "none"; // Hide preloader
    content.style.display = "block"; // Show content
  });

  // Ensure the content is initially hidden
  content.style.display = "none";
});
