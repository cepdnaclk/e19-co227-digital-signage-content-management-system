document.addEventListener("DOMContentLoaded", function () {
    const profile = document.querySelector(".profile");
    const dropdown = document.querySelector(".profile-dropdown");
  
    profile.addEventListener("mouseenter", function () {
      dropdown.style.display = "block";
    });
  
    profile.addEventListener("mouseleave", function () {
      // Delay the dropdown hiding for a few seconds
      setTimeout(function () {
        dropdown.style.display = "none";
      }, 600); // Adjust the delay time as needed (in milliseconds)
    });
  });
  