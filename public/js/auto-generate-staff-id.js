document.addEventListener("DOMContentLoaded", function () {
    const checkbox = document.getElementById("autoGenerateStaffId");
    const input = document.getElementById("staffNumberInput");

    if (!checkbox || !input) return;

    function toggleStaffNumberInput() {
        if (checkbox.checked) {
            input.value = "";
            input.disabled = true;
            input.classList.add("bg-slate-100", "cursor-not-allowed");
        } else {
            input.disabled = false;
            input.classList.remove("bg-slate-100", "cursor-not-allowed");
        }
    }

    checkbox.addEventListener("change", toggleStaffNumberInput);
    toggleStaffNumberInput();
});
