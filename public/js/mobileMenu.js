const mobileMenuBtn = document.getElementById("mobileMenuBtn");
const mobileMenu = document.getElementById("mobileMenu");
const closeMobileMenu = document.getElementById("closeMobileMenu");
const mobileMenuOverlay = document.getElementById("mobileMenuOverlay");

mobileMenuBtn.addEventListener("click", () => {
    mobileMenu.classList.add("active");
    mobileMenuOverlay.classList.remove("hidden");
});

closeMobileMenu.addEventListener("click", () => {
    mobileMenu.classList.remove("active");
    mobileMenuOverlay.classList.add("hidden");
});

mobileMenuOverlay.addEventListener("click", () => {
    mobileMenu.classList.remove("active");
    mobileMenuOverlay.classList.add("hidden");
});

function toggleAdmissionsMenu() {
    const submenu = document.getElementById("admissionsSubmenu");
    const chevron = document.getElementById("admissionsChevron");

    submenu.classList.toggle("hidden");
    chevron.classList.toggle("rotate-180");
}
