const confirmInput = document.getElementById("confirmInput");
const deleteBtn = document.getElementById("deleteBtn");

confirmInput.addEventListener("input", function () {
    deleteBtn.disabled = this.value.toUpperCase() !== "CONFIRM";
});
