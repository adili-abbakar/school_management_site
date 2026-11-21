$("#authForm").on("submit", function (e) {
    e.preventDefault();
    showLoader();

    $.post($(this).attr("action"), $(this).serialize(), function (data) {
        if (data.status === "success") {
            window.location.assign(data.redirect);
        } else if (data.type === "validation") {
            hideLoader();
            $.each(data.errors, function (field, messages) {
                $("#" + field + "Error").text(messages[0]);
                $("#" + field).addClass("border-red-600!");
            });
        } else if (data.type === "auth") {
            hideLoader();
            $("#globalError span").text(data.message);
            $("#globalError").css("max-height", "200px");
            setTimeout(() => $("#globalError").css("max-height", "0px"), 3000);
        }
    }).fail(function (xhr) {
        hideLoader();
        console.error("Server error:", xhr.responseText);
    });
});
