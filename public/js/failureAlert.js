function showFailure(message = "Failure! Your action was failed.") {
    const alert = document.createElement("div");
    alert.className = `
      fixed top-5 right-0 transform translate-x-full
      bg-red-600 text-white px-6 py-3 rounded shadow-lg flex items-center gap-2
      transition-transform duration-500 ease-in-out
      z-50
    `;
    alert.innerHTML = `<i class="fas fa-check-circle"></i> <span>${message}</span>`;

    document.body.appendChild(alert);

    setTimeout(() => {
        alert.classList.remove("translate-x-full");
        alert.classList.add("-translate-x-5");
    }, 100);

    setTimeout(() => {
        alert.classList.remove("-translate-x-5");
        alert.classList.add("translate-x-full");
        setTimeout(() => alert.remove(), 500);
    }, 3000);
}
