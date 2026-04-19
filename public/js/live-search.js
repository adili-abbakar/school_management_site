document.addEventListener("DOMContentLoaded", function () {
    const liveSearchContainers =
        document.querySelectorAll("[data-live-search]");

    liveSearchContainers.forEach((container) => {
        const input = container.querySelector("[data-search-input]");
        const resultsContainer = container.querySelector(
            "[data-search-results]"
        );
        const paginationContainer = container.querySelector(
            "[data-search-pagination]"
        );
        const searchUrl = container.dataset.searchUrl;
        const searchDelay = parseInt(container.dataset.searchDelay || 300);

        if (!input || !resultsContainer || !paginationContainer || !searchUrl)
            return;

        let debounceTimer;

        input.addEventListener("input", function () {
            clearTimeout(debounceTimer);

            debounceTimer = setTimeout(() => {
                fetchSearchResults(container, searchUrl, input.value);
            }, searchDelay);
        });

        container.addEventListener("click", function (e) {
            const link = e.target.closest("[data-search-pagination] a");
            if (!link) return;

            e.preventDefault();
            fetchSearchResults(container, link.href, input.value);
        });
    });

    function fetchSearchResults(container, url, search = "") {
        const resultsContainer = container.querySelector(
            "[data-search-results]"
        );
        const paginationContainer = container.querySelector(
            "[data-search-pagination]"
        );

        const separator = url.includes("?") ? "&" : "?";
        const requestUrl = url.includes("search=")
            ? url
            : `${url}${separator}search=${encodeURIComponent(search)}`;

        container.classList.add("opacity-75", "pointer-events-none");

        fetch(requestUrl, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                Accept: "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.html !== undefined) {
                    resultsContainer.innerHTML = data.html;
                }

                if (data.pagination !== undefined) {
                    paginationContainer.innerHTML = data.pagination;
                }
            })
            .catch((error) => {
                console.error("Live search error:", error);
            })
            .finally(() => {
                container.classList.remove("opacity-75", "pointer-events-none");
            });
    }
});
