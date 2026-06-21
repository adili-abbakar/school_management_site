document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("select[data-target]").forEach((parentSelect) => {
        async function loadOptions() {
            const targetId = parentSelect.dataset.target;
            const targetSelect = document.getElementById(targetId);

            const routeTemplate = parentSelect.dataset.route;
            const value = parentSelect.value;

            if (!value) {
                targetSelect.disabled = true;
                targetSelect.innerHTML = `<option value="">Select first</option>`;
                return;
            }

            try {
                targetSelect.disabled = true;
                targetSelect.innerHTML = `<option value="">Loading...</option>`;

                const url = routeTemplate.replace("{id}", value);

                const response = await fetch(url);

                if (!response.ok) {
                    throw new Error("Failed to load data");
                }

                const items = await response.json();

                const selectedValue = targetSelect.dataset.selected;

                targetSelect.innerHTML = `<option value="">Select option</option>`;

                items.forEach((item) => {
                    const option = document.createElement("option");

                    option.value = item.id;
                    option.textContent = item.name;

                    if (selectedValue == item.id) {
                        option.selected = true;
                    }

                    targetSelect.appendChild(option);
                });

                targetSelect.disabled = false;
            } catch (error) {
                console.error(error);

                targetSelect.innerHTML = `<option value="">Unable to load data</option>`;

                targetSelect.disabled = true;
            }
        }

        parentSelect.addEventListener("change", loadOptions);

        // Important for edit forms
        if (parentSelect.value) {
            loadOptions();
        }
    });
});
