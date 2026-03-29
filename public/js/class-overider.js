 const form = document.querySelector('form');
        const saveBtn = document.querySelector('button[type="submit"]') || document.getElementById('saveBtn');
        const checkbox = document.getElementById('force_overwrite');
        const modal = document.getElementById('confirmModal');
        const cancel = document.getElementById('cancelConfirm');
        const confirm = document.getElementById('confirmSubmit');

        // Intercept submit: if checkbox checked, show modal; otherwise submit normally
        (saveBtn || form).addEventListener('click', function(e) {
            // if this is the form submit button, prevent default to control flow
            if (checkbox && checkbox.checked) {
                e.preventDefault();
                modal.classList.remove('hidden');
                return;
            }
            // allow normal submit when not checked
        });

        cancel.addEventListener('click', () => modal.classList.add('hidden'));
        confirm.addEventListener('click', () => {
            modal.classList.add('hidden');
            // submit the form programmatically
            form.submit();
        });