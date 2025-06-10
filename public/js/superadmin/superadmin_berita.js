document.addEventListener("DOMContentLoaded", () => {
    const hamburger = document.getElementById("hamburgerBtn");
    const sidebar = document.getElementById("sidebar");

    if (hamburger) {
        hamburger.addEventListener("click", () => {
            sidebar.classList.toggle("open");
        });
    }
});