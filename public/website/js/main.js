
// toggle menu start
const toggle_menu_btn = document.getElementById("toggle_menu_btn");
const toggle_menu_items = document.getElementById("toggle_menu_items");

// Toggle the menu when the button is clicked
toggle_menu_btn.addEventListener("click", (event) => {
    event.stopPropagation(); // Prevent this click from being caught by the document event
    toggle_menu_items.classList.toggle("hidden");
});

// Hide the menu when clicking outside of it
document.addEventListener("click", (event) => {
    const isClickInsideMenu = toggle_menu_items.contains(event.target);
    const isClickOnButton = toggle_menu_btn.contains(event.target);

    // If the click is not inside the menu or on the button, hide the menu
    if (!isClickInsideMenu && !isClickOnButton) {
        toggle_menu_items.classList.add("hidden");
    }
});
// toggle menu end

// toggle share items start
const toggle_share_btn = document.getElementById("toggle_share_btn");
const toggle_share_items = document.getElementById("toggle_share_items");

// Toggle the menu when the button is clicked
toggle_share_btn.addEventListener("click", (event) => {
    event.stopPropagation(); // Prevent this click from being caught by the document event
    toggle_share_items.classList.toggle("hidden");
});

// Hide the menu when clicking outside of it
document.addEventListener("click", (event) => {
    const isClickInsideMenu = toggle_share_items.contains(event.target);
    const isClickOnButton = toggle_share_btn.contains(event.target);

    // If the click is not inside the menu or on the button, hide the menu
    if (!isClickInsideMenu && !isClickOnButton) {
        toggle_share_items.classList.add("hidden");
    }
});
// toggle share items end


function handlePrint() {
    window.print();
}
