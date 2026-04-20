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
        let controller = null;
        let loaderTimer = null;

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

        function fetchSearchResults(container, url, search = "") {
            const resultsContainer = container.querySelector(
                "[data-search-results]"
            );
            const paginationContainer = container.querySelector(
                "[data-search-pagination]"
            );

            if (controller) {
                controller.abort();
            }

            controller = new AbortController();

            const parsedUrl = new URL(url, window.location.origin);
            parsedUrl.searchParams.set("search", search);

            clearTimeout(loaderTimer);
            loaderTimer = setTimeout(() => {
                showLoader();
            }, 200);

            fetch(parsedUrl.toString(), {
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    Accept: "application/json",
                },
                signal: controller.signal,
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error(
                            `HTTP error! Status: ${response.status}`
                        );
                    }
                    return response.json();
                })
                .then((data) => {
                    if (data.html !== undefined) {
                        resultsContainer.innerHTML = data.html;
                    }

                    if (data.pagination !== undefined) {
                        paginationContainer.innerHTML = data.pagination;
                    }
                })
                .catch((error) => {
                    if (error.name !== "AbortError") {
                        console.error("Live search error:", error);
                    }
                })
                .finally(() => {
                    clearTimeout(loaderTimer);
                    hideLoader();
                });
        }
    });
});
