const form = document.querySelector(".form");
const saveBtn =
    document.querySelector('button[type="submit"]') ||
    document.getElementById("saveBtn");
const checkbox = document.getElementById("force_overwrite");
const modal = document.getElementById("confirmModal");
const cancel = document.getElementById("cancelConfirm");
const confirm = document.getElementById("confirmSubmit");

(saveBtn || form).addEventListener("click", function (e) {
    if (checkbox && checkbox.checked) {
        e.preventDefault();
        modal.classList.remove("hidden");
        return;
    }
});

cancel.addEventListener("click", () => modal.classList.add("hidden"));
confirm.addEventListener("click", () => {
    modal.classList.add("hidden");
    form.requestSubmit();
});
