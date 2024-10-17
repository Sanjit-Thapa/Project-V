// script for the dashboard
let burgerBtn = document.getElementById("burgerBtn")

burgerBtn.addEventListener("click", (evt) => {
    let sidebar = document.getElementById("menu");
    let labels = document.getElementsByClassName("label");

    // If the sidebar is currently 17% wide
    if (sidebar.classList.contains("w-[17%]")) {
        sidebar.style.width = "5%";

        // Hide labels
        for (let i = 0; i < labels.length; i++) {
            labels[i].style.display = "none";
        }

        // Remove 'w-[17%]' class and add 'w-[5%]' class
        sidebar.classList.remove("w-[17%]");
        sidebar.classList.add("w-[5%]");
    } 
    // If the sidebar is currently 5% wide
    else if (sidebar.classList.contains("w-[5%]")) {
        sidebar.style.width = "17%";

        // Show labels as flex items
        for (let i = 0; i < labels.length; i++) {
            labels[i].style.display = "inline"; // Use flex here to keep the flexbox layout
        }

        // Remove 'w-[5%]' class and add 'w-[17%]' class
        sidebar.classList.remove("w-[5%]");
        sidebar.classList.add("w-[17%]");
    }
});



