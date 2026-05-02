document.addEventListener("DOMContentLoaded", function () {
    const checkbox = document.getElementById("autoGenerateId");
    const input = document.getElementById("idNumberInput");

    if (!checkbox || !input) return;

    function toggleIdNumberInput() {
        if (checkbox.checked) {
            input.value = "";
            input.disabled = true;
            input.classList.add(
                "bg-slate-100",
                "text-slate-400",
                "border-dashed",
                "border-slate-300",
                "cursor-not-allowed",
                "placeholder:text-slate-400"
            );
        } else {
            input.disabled = false;
            input.classList.remove(
                "bg-slate-100",
                "text-slate-400",
                "border-dashed",
                "border-slate-300",
                "cursor-not-allowed",
                "placeholder:text-slate-400"
            );
        }
    }

    checkbox.addEventListener("change", toggleIdNumberInput);
    toggleIdNumberInput();
});
