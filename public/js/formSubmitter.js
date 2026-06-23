function convertFormat(input) {
    const parts = input.split(".");
    let result = parts[0];

    for (let i = 1; i < parts.length; i++) {
        result += `[${parts[i]}]`;
    }

    return result;
}

$(".form").on("submit", function (e) {
    e.preventDefault();
    showLoader();

    $(".error-message").text("");
    $("input, select, textarea").removeClass("!border-red-600");

    let form = $(this);
    let actionUrl = form.attr("action");
    let method = form.attr("method");

    $.ajax({
        url: actionUrl,
        type: method,
        data: form.serialize(),
        success: function (data) {
            if (data.status === "success") {
                window.location.assign(data.redirect);
            } else if ((data.status === "field-error")) {
                hideLoader();
                $("#globalError span").text(data.message);
                $("#globalError").css("max-height", "200px");
            }
        },
        error: function (xhr) {
            hideLoader();
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                $.each(errors, function (field, messages) {
                    $(`.error-message[data-name="${field}"]`).text(messages[0]);
                    let inputName = convertFormat(field);
                    $(`[name="${inputName}"]`).addClass("!border-red-600");
                });
            } else {
                console.error("Server error:", xhr.responseText);
            }
        },
    });
});
