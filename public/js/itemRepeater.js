document.querySelectorAll(".repeater-wrapper").forEach((wrapper) => {
    const group = wrapper.dataset.group;

    const addBtn = wrapper.querySelector(".add-repeater-item-btn");

    const container = wrapper.querySelector(".repeater-container");

    function reindexRepeaterItems() {
        const items = container.querySelectorAll(".repeater-item");

        items.forEach((item, index) => {
            // Dynamic fields
            item.querySelectorAll("[data-field]").forEach((field) => {
                const fieldName = field.dataset.field;

                // Skip error spans
                if (field.classList.contains("error-message")) {
                    return;
                }

                field.name = `${group}[${index}][${fieldName}]`;
            });

            // Dynamic errors
            item.querySelectorAll(".error-message").forEach((span) => {
                const fieldName = span.dataset.field;

                span.setAttribute(
                    "data-name",
                    `${group}.${index}.${fieldName}`,
                );
            });

            // Remove button visibility
            const removeBtn = item.querySelector(".remove-repeater-item-btn");

            if (removeBtn) {
                removeBtn.style.display =
                    items.length === 1 ? "none" : "inline-block";
            }
        });
    }

    function attachRemoveListener(btn) {
        if (!btn) return;

        btn.addEventListener("click", (e) => {
            e.preventDefault();

            btn.closest(".repeater-item").remove();

            reindexRepeaterItems();
        });
    }

    addBtn?.addEventListener("click", (e) => {
        e.preventDefault();

        const template = container.querySelector(".repeater-item");

        const clone = template.cloneNode(true);

        // Clear inputs
        clone.querySelectorAll("input").forEach((input) => {
            if (input.type === "checkbox" || input.type === "radio") {
                input.checked = false;
            } else {
                input.value = "";
            }
        });

        // Reset selects
        clone.querySelectorAll("select").forEach((select) => {
            select.selectedIndex = 0;
        });

        // Reset textareas
        clone.querySelectorAll("textarea").forEach((textarea) => {
            textarea.value = "";
        });

        // Clear errors
        clone.querySelectorAll(".error-message").forEach((span) => {
            span.textContent = "";

            span.setAttribute("data-name", "");
        });

        container.appendChild(clone);

        attachRemoveListener(clone.querySelector(".remove-repeater-item-btn"));

        reindexRepeaterItems();
    });

    // Existing remove buttons
    container.querySelectorAll(".remove-repeater-item-btn").forEach((btn) => {
        attachRemoveListener(btn);
    });

    reindexRepeaterItems();
});
