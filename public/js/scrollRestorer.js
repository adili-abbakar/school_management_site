// Save scroll position before reload
window.addEventListener("beforeunload", function () {
    sessionStorage.setItem(
        "scrollPosition_" + location.pathname,
        window.scrollY
    );
});

// Restore scroll position on reload
window.addEventListener("load", function () {
    const scrollPosition = sessionStorage.getItem(
        "scrollPosition_" + location.pathname
    );
    if (scrollPosition) {
        window.scrollTo(0, scrollPosition);
    }
});
