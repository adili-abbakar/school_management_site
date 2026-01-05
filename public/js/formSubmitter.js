$("#form").on("submit", function (e) {
  e.preventDefault();
  showLoader();

  $(".error-message").text("");
  $("input, select, textarea").removeClass("border-red-600");

  let form = $(this);
  let actionUrl = form.attr("action");
  let method = form.attr("method");

  $.ajax({
    url: actionUrl,
    type: method,
    data: form.serialize(),
    success: function (response) {
      if (response.status === "success") {
        if (response.redirect) {
          window.location.href = response.redirect;
        } else {
          window.history.back();
        }
      }
    },
    error: function (xhr) {
      hideLoader();
      if (xhr.status === 422) {
        let errors = xhr.responseJSON.errors;
        $.each(errors, function (field, messages) {
          $(`.error-message[data-name="${field}"]`).text(messages[0]);
          $(`[name="${field}"]`).addClass("border-red-600");
        });
      } else {
        console.error("Server error:", xhr.responseText);
      }
    },
  });
});
