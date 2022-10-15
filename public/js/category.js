$(document).ready(function () {
  // ADD AND UPDATE
  $("#categoryAdd").on('submit', function (e) {
    e.preventDefault();

    const action = this.action;

    $.ajax({
      type: 'post',
      url: action,
      dataType: 'json',
      data: new FormData(this),
      processData: false,
      contentType: false,
      beforeSend: function () {
        $("#overlay").fadeIn();
      },
      success: function (response) {
        $("#overlay").fadeOut();
        const { error, model } = response;

        if (error) {
          const name = $(`input[name=name]`);
          const formGroup = name.parent().find(".invalid-feedback");

          formGroup.text('');
          name.removeClass('is-invalid');

          if (model.errors.name) {
            name.addClass('is-invalid');
            formGroup.text(model.errors.name[0]);
          }

          return;
        }

        window.location.href = cutUrl(action);
      },
      error: function (e) {
        $("#overlay").fadeOut();
        console.log("Oops! Something went wrong! ", e.responseText);

        toast({
          title: 'Error',
          message: e.responseText,
          type: 'error',
          duration: 3000
        })
      },
    })
  })

  function cutUrl(url = '') {
    if (!url)
      return '';

    const array = url.split("/");
    return url.slice(0, -array[array.length - 1].length);
  }

  // HANDLE MODAL DELETE
  $('button[name="delete-category"]').on('click', function (e) {
    e.preventDefault();

    const form = $(this).closest('form');

    const nameTd = $(this).closest('tr').find('td:first');

    if (nameTd.length > 0) {
      $('.modal-body').html(
        `Bạn có muốn xóa "${nameTd.text()}"?`
      );
    }
    $('#modal-delete').modal({
      backdrop: 'static',
      keyboard: false
    })
      .one('click', '#delete-category-confirm', function () {
        form.trigger('submit');
      });
  });

  // DELETE
  $("#delete").on('submit', function (e) {
    e.preventDefault();

    const action = this.action;

    console.log(action);

    $.ajax({
      type: 'post',
      url: action,
      dataType: 'json',
      data: new FormData(this),
      processData: false,
      contentType: false,
      beforeSend: function () {
        $("#overlay").fadeIn();
      },
      success: function (response) {
        $("#overlay").fadeOut();
        if (!response.error)
          window.location.href = cutUrl(action);
      },
      error: function (e) {
        $("#overlay").fadeOut();
        console.log("Oops! Something went wrong! ", e.responseText);

        toast({
          title: 'Error',
          message: e.responseText,
          type: 'error',
          duration: 3000
        })
      },
    })
  })
})