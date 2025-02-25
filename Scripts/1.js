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

<<<<<<< HEAD

=======
>>>>>>> b8160863a50b6054e091360ab417c7a5aa8ade11
