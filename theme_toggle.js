document.addEventListener("DOMContentLoaded", function () {
    let themeToggle = document.getElementById("themeToggle");

    // Check if the button exists before proceeding
    if (!themeToggle) {
        console.error("Error: Theme toggle button not found!");
        return; // Stop script execution if the button is missing
    }

    // Apply the stored theme preference
    if (localStorage.getItem("theme") === "dark") {
        document.documentElement.setAttribute("data-theme", "dark");
        themeToggle.innerHTML = '<i class="fa-solid fa-sun"></i> Light Mode';
    }

    // Add the click event listener safely
    themeToggle.addEventListener("click", function () {
        let theme = document.documentElement.getAttribute("data-theme");
        if (theme === "dark") {
            document.documentElement.setAttribute("data-theme", "light");
            localStorage.setItem("theme", "light");
            this.innerHTML = '<i class="fa-solid fa-moon"></i> Dark Mode';
        } else {
            document.documentElement.setAttribute("data-theme", "dark");
            localStorage.setItem("theme", "dark");
            this.innerHTML = '<i class="fa-solid fa-sun"></i> Light Mode';
        }
    });
});
