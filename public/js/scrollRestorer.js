window.addEventListener("beforeunload", function () {
    sessionStorage.setItem(
        "scrollPosition_" + location.pathname,
        window.scrollY,
    );
});

window.addEventListener("load", function () {
    const navigation = performance.getEntriesByType("navigation")[0];

    if (navigation && navigation.type === "reload") {
        const scrollPosition = sessionStorage.getItem(
            "scrollPosition_" + location.pathname,
        );

        if (scrollPosition !== null) {
            window.scrollTo(0, parseInt(scrollPosition, 10));
        }
    } else {
        // Remove any old value when arriving normally
        sessionStorage.removeItem("scrollPosition_" + location.pathname);
    }
});
