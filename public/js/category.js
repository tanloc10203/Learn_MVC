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

  let total_pages = 0;

  handleGetAll({ limit: 5 });

  function handleGetAll(data = {}) {
    const action = this.location.href;

    $("#overlay").fadeIn();

    $.post(action, data, function (response) {
      const { data, total_rows } = response;

      total_pages = total_rows;

      $("#overlay").fadeOut();

      $('tbody').empty();

      if (data?.length === 0)
        return $('tbody').append(`<tr> <td colspan="4">Không có danh mục nào</td> </tr>`);


      const tr = `${data?.map(category => (
        `
        <tr>
          <th scope="row">${category?.id}</th>
          <td>${category?.name}</td>
          <td>
            <a href="${action}/update/${category.id}" class="btn btn-primary btn-size-small">Sửa</a>

            <form action="${action}/delete" method="post" id="delete" class="d-inline">            
              <input type="hidden" name="id" value="${category.id}">
              <button type="button" id="delete-category" data-toggle="modal" data-target="#modal-delete" class="btn btn-danger btn-size-small">Xóa</button>
            </form>
          </td>
        </tr>
        `
      )).join('')}`;

      $('.pagination-category').empty();

      if (total_rows > 0) {
        const next = `
        <li class="page-item" id="prev">
          <a class="page-link" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>`

        const prev = `
        <li class="page-item" id="next">
          <a class="page-link" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>`

        $('.pagination-category').append(function () {
          let varchar = '';

          varchar += next;

          for (let i = 1; i <= total_rows; i++)
            varchar += `<li class="page-item" id="${i}"><a class="page-link">${i}</a></li>`;

          varchar += prev;

          return varchar;
        })
      }

      $('tbody').append(tr);
    }, 'json').fail(function (error) {
      toast({
        title: 'Error',
        message: error.responseText,
        type: 'error',
        duration: 3000
      })
    });
  }

  // HANDLE MODAL DELETE
  $(document).on('click', "#delete-category", function (e) {
    e.preventDefault();

    const form = $(this).closest('form');

    const nameTd = $(this).closest('tr').find('td:first');

    if (nameTd.length > 0) {
      $('.modal-body').html(
        `Bạn có muốn xóa <strong>"${nameTd.text()}"</strong>?`
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
  $(document).on('submit', "#delete", function (e) {
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
      },
      success: function (response) {

        if (!response.error) {
          handleGetAll();
          $('#modal-delete').modal('hide')
          toast({
            title: 'Success',
            message: "Xóa thành công",
            type: 'success',
            duration: 3000
          })
        }
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

  // SEARCH WITH DEBOUNCE
  let debounce;
  $(document).on('keyup input', '#search', function (e) {
    const action = this.action;

    clearTimeout(debounce);

    debounce = setTimeout(() => {
      $.ajax({
        type: 'post',
        url: action,
        dataType: 'json',
        data: new FormData(this),
        processData: false,
        contentType: false,
        beforeSend: function () {
          // $("#overlay").fadeIn();
        },
        success: function (response) {

          const { data } = response;

          if (Object.keys(data).length > 0) {
            const params = {
              name_like: data.search_category,
              name_query: 'name',
              page: 0,
              limit: 5
            }

            handleGetAll(params);
          }
        },
        error: function (e) {
          console.log("Oops! Something went wrong! ", e.responseText);

          toast({
            title: 'Error',
            message: e.responseText,
            type: 'error',
            duration: 3000
          })
        },
      })
    }, 500);
  })

  let page = 1;

  $(document).on("click", ".page-item", function (e) {
    const baseUri = this.baseURI;

    if (parseInt($(this).attr('id')))
      page = parseInt($(this).attr('id'));

    const action = baseUri + `/pagination/${$(this).attr("id")}`;

    $.ajax({
      type: 'get',
      url: action,
      dataType: 'json',
      data: page,
      processData: false,
      contentType: false,
      beforeSend: function () {
      },
      success: function (response) {
        let newPage = 0;

        if (response.page === 'next') {
          if (page < total_pages) {
            newPage = page + 1;
          } else {
            newPage = total_pages
          }
        } else if (response.page === 'prev') {
          newPage = page - 1;
        } else {
          newPage = response.page;
        }

        page = newPage;

        handleGetAll({ page: newPage, limit: 5 });

      },
      error: function (e) {
        $("#overlay").fadeOut();
        console.log("Oops! Something went wrong! ", e);

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