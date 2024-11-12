(function () {
    emailjs.init("iBlg6K0pNW81tPXUQ0Pv0");
  })();

  document.getElementById("newsletterForm").addEventListener("submit", function (event) {
    event.preventDefault();

    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;

    if (!name || !email) {
      alert("Please enter both your name and email.");
      return;
    }

    emailjs.send("service_0kn8v47", "template_gc5d7ed", {
      from_name: name,
      reply_to: email,
    })
      .then(function (response) {
        alert("Thank you! A confirmation email has been sent.");
        console.log('Email successfully sent!', response.status, response.text);
      }, function (error) {
        alert("Failed to send the email. Please try again.");
        console.error('Failed to send email:', error);
      });
  });