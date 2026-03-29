const addArmBtn = document.getElementById("addArmBtn");
const armsContainer = document.getElementById("armsContainer");

function reindexArms() {
    const armItems = armsContainer.querySelectorAll(".arm-item");

    armItems.forEach((arm, index) => {
        // Target fields explicitly (BEST PRACTICE)
        const nameInput = arm.querySelector('input[name*="[name]"]');
        const teacherSelect = arm.querySelector(
            'select[name*="[form_teacher]"]'
        );
        const maxInput = arm.querySelector('input[name*="[max_students]"]');

        const errorSpans = arm.querySelectorAll(".error-message");

        // Assign correct names
        if (nameInput) {
            nameInput.name = `arms[${index}][name]`;
        }

        if (teacherSelect) {
            teacherSelect.name = `arms[${index}][form_teacher]`;
        }

        if (maxInput) {
            maxInput.name = `arms[${index}][max_students]`;
        }

        // Assign error mapping
        if (errorSpans[0]) {
            errorSpans[0].setAttribute("data-name", `arms.${index}.name`);
        }

        if (errorSpans[1]) {
            errorSpans[1].setAttribute(
                "data-name",
                `arms.${index}.form_teacher`
            );
        }

        if (errorSpans[2]) {
            errorSpans[2].setAttribute(
                "data-name",
                `arms.${index}.max_students`
            );
        }
    });

    // Toggle remove buttons
    armItems.forEach((arm) => {
        const removeBtn = arm.querySelector(".remove-arm-btn");
        removeBtn.style.display =
            armItems.length === 1 ? "none" : "inline-block";
    });
}

function attachRemoveListener(btn) {
    btn.addEventListener("click", (e) => {
        e.preventDefault();
        btn.closest(".arm-item").remove();
        reindexArms();
    });
}

addArmBtn.addEventListener("click", (e) => {
    e.preventDefault();

    const templateArm = armsContainer.querySelector(".arm-item");
    const newArm = templateArm.cloneNode(true);

    // Clear inputs
    newArm.querySelectorAll("input").forEach((input) => {
        input.value = "";
    });

    // Reset selects
    newArm.querySelectorAll("select").forEach((select) => {
        select.selectedIndex = 0;
    });

    // Clear errors
    newArm.querySelectorAll(".error-message").forEach((span) => {
        span.textContent = "";
        span.setAttribute("data-name", "");
    });

    armsContainer.appendChild(newArm);

    attachRemoveListener(newArm.querySelector(".remove-arm-btn"));

    reindexArms();
});

// Attach listeners to existing remove buttons
document
    .querySelectorAll(".remove-arm-btn")
    .forEach((btn) => attachRemoveListener(btn));

// Initial run
reindexArms();

