window.addEventListener("load", function() {
  setTimeout(function() {
    const preloader = document.getElementById("preloader");
    preloader.classList.add("hidden");
    setTimeout(function() {
      preloader.style.display = "none";
      document.getElementById("content").style.display = "block";
    }, 3000);
  }, 1);
});

