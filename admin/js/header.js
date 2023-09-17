
// JavaScript to toggle the menu on button click
const menuButton = document.querySelector(".menu-button");
const menu = document.querySelector(".menu ul");
const menuItems = document.querySelectorAll(".menu ul li");

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

