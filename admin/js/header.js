// JavaScript to toggle the menu on button click
const menuButton = document.querySelector(".menu-button");
const menu = document.querySelector(".menu ul");
const menuItems = document.querySelectorAll(".menu ul li");
const eventsMenuItem = document.querySelector(".dropdown"); // Select the "Events & Achievements" menu item
const dropdownMenu = eventsMenuItem.querySelector(".dropdown-menu");

// Function to add "selected" class to the clicked menu item
function selectMenuItem(event) {
    menuItems.forEach((item) => item.classList.remove("selected"));
    event.target.classList.add("selected");
}

// Event listeners
menuButton.addEventListener("click", () => {
    menu.classList.toggle("active");
});

menuItems.forEach((item) => {
    item.addEventListener("click", selectMenuItem);
});

// Hide the dropdown by default
dropdownMenu.style.display = "none";

// Add event listener to show the dropdown on hover
eventsMenuItem.addEventListener("mouseenter", () => {
    setInterval(() => {
    dropdownMenu.style.display = "block";
    },500);
});

// Keep the dropdown visible for a bit longer when leaving the menu item
eventsMenuItem.addEventListener("mouseleave", () => {
    setTimeout(() => {
        dropdownMenu.style.display = "none";
    }, 500); // Adjust the delay time (in milliseconds) as needed
});
