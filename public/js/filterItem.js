function filterItem(status, button) {
    document.querySelectorAll(".status-btn").forEach((btn) => {
        btn.classList.remove("bg-primary", "text-white");
        btn.classList.add("text-slate-500");
    });

    button.classList.remove("text-slate-500");
    button.classList.add("bg-primary", "text-white");

    let visibleCount = 0;

    document.querySelectorAll(".item-to-filter").forEach((el) => {
        const itemStatus = el.dataset.status;

        if (status === "all" || itemStatus === status) {
            el.classList.remove("hidden");
            el.classList.add("fade-in");
            visibleCount++;
        } else {
            el.classList.add("hidden");
        }
    });

    const emptyState = document.getElementById("emptyState");

    if (visibleCount === 0) {
        emptyState.classList.remove("hidden");
        emptyState.textContent =
            status === "all"
                ? "No admission applications found."
                : `No ${status} admission applications found.`;
    } else {
        emptyState.classList.add("hidden");
    }
}
