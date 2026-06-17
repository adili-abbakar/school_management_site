document.addEventListener("DOMContentLoaded", () => {
    const sectionSelect = document.getElementById("section_id");
    const levelSelect = document.getElementById("level_id");

    async function loadLevels() {
        const sectionId = sectionSelect.value;
        const selectedLevel = levelSelect.dataset.selected;

        if (!sectionId) {
            levelSelect.disabled = true;

            levelSelect.innerHTML =
                '<option value="" selected disabled>Select Section First</option>';

            return;
        }

        try {
            levelSelect.disabled = true;

            levelSelect.innerHTML =
                '<option value="" selected disabled>Loading levels...</option>';

            const response = await fetch(`/sections/${sectionId}/levels`);

            if (!response.ok) {
                throw new Error("Failed to load levels");
            }

            const levels = await response.json();

            levelSelect.innerHTML =
                '<option value="" selected disabled>Select Level</option>';

            levels.forEach((level) => {
                const option = document.createElement("option");

                option.value = level.id;
                option.textContent = level.name;

                if (selectedLevel == level.id) {
                    option.selected = true;
                }

                levelSelect.appendChild(option);
            });

            levelSelect.disabled = false;
        } catch (error) {
            console.error(error);

            levelSelect.innerHTML =
                '<option value="" selected disabled>Unable to load levels</option>';

            levelSelect.disabled = true;
        }
    }

    // Load automatically on page load
    loadLevels();

    // Reload when section changes
    sectionSelect.addEventListener("change", () => {
        levelSelect.dataset.selected = "";

        loadLevels();
    });
});
