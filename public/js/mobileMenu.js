// Mobile Menu Logic
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
