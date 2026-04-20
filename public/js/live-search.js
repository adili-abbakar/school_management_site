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

        if (!resultsContainer || !paginationContainer || !searchUrl) return;

        const filterInputs = container.querySelectorAll("[data-search-filter]");
        const filterButton = container.querySelector(
            "[data-search-filter-button]"
        );

        let debounceTimer;
        let controller = null;
        let loaderTimer = null;

        if (input) {
            input.addEventListener("input", function () {
                clearTimeout(debounceTimer);

                debounceTimer = setTimeout(() => {
                    fetchSearchResults(searchUrl);
                }, searchDelay);
            });
        }

        if (filterButton) {
            filterButton.addEventListener("click", function () {
                fetchSearchResults(searchUrl);
            });
        }
        filterInputs.forEach((filter) => {
            filter.addEventListener("change", function () {
                fetchSearchResults(searchUrl);
            });
        });

        container.addEventListener("click", function (e) {
            const link = e.target.closest("[data-search-pagination] a");
            if (!link) return;

            e.preventDefault();
            fetchSearchResults(link.href);
        });

        function fetchSearchResults(url) {
            if (controller) {
                controller.abort();
            }

            controller = new AbortController();

            const parsedUrl = new URL(url, window.location.origin);

            if (input) {
                parsedUrl.searchParams.set("search", input.value || "");
            }

            filterInputs.forEach((filter) => {
                if (!filter.name) return;

                if (filter.value !== "") {
                    parsedUrl.searchParams.set(filter.name, filter.value);
                } else {
                    parsedUrl.searchParams.delete(filter.name);
                }
            });

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
