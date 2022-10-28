$(document).ready(function () {
  let total_pages = 0;

  function handleGetAll(data = {}) {
    const action = this.location.href;

    $("#overlay").fadeIn();

    $.post(action, data, function (response) {
      $("#overlay").fadeOut();
      const { data, total_rows, path_img } = response;

      total_pages = total_rows;

      $('tbody').empty();

      if (data?.length === 0)
        return $('tbody').append(`<tr> <td colspan="6">Không có thành viên nào</td> </tr>`);

      const tr = `${data?.map(member => (
        `
        <tr>
          <th scope="row">${member.id}</th>
          <td>
            <img src="${path_img + member.thumb}" alt="" class="img-thumbnail img-user">
          </td>
          <td>${member.fullName}</td>
          <td>${member.username}</td>
          <td>${member.role}</td>
          <td>
            <a href="${action}/update?id=${member.id}" class="btn btn-primary btn-size-small">Sửa</a>

            <form action="${action}/delete?id=${member.id}" method="post" id="delete" class="d-inline">            
              <button id="delete-member" data-toggle="modal" data-target="#modal-delete" class="btn btn-danger btn-size-small">Xóa</button>
            </form>
          </td>
        </tr>
        `
      )).join('')}`;

      $('.pagination-member').empty();

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

        $('.pagination-member').append(function () {
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
      $("#overlay").fadeOut();
      console.log(error.responseText);
    });
  }

  function cutUrl(url = '') {
    if (!url)
      return '';

    const array = url.split("/");
    return url.slice(0, -array[array.length - 1].length);
  }

  // HANDLE MODAL DELETE
  $(document).on('click', "#delete-member", function (e) {
    e.preventDefault();

    const form = $(this).closest('form');

    const nameTd = $(this).closest('tr').find('td:nth-child(3)');

    if (nameTd.length > 0) {
      $('.modal-body').html(
        `Bạn có muốn xóa <strong>"${nameTd.text()}"</strong>?`
      );
    }
    $('#modal-delete').modal({
      backdrop: 'static',
      keyboard: false
    })
      .one('click', '#delete-member-confirm', function () {
        form.trigger('submit');
      });
  });

  handleGetAll({ limit: 5 });

  $("#add_member").on("submit", function (e) {
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

        console.log(cutUrl(action))

        if (error) {
          const keys = Object.keys(model);

          // delete key errors first array
          keys.shift();

          keys.forEach(i => {
            let element = $(`input[name=${i}]`);

            if (element.length === 0)
              element = $(`select[name=${i}]`);

            const formGroup = element.parent().find(".invalid-feedback");

            formGroup.text('');
            element.removeClass('is-invalid');

            if (model.errors[i]) {
              element.addClass('is-invalid');
              formGroup.text(model.errors[i][0]);
            }
          });

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
          handleGetAll({ limit: 5, page: 0 });
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

          console.log(data);

          if (Object.keys(data).length > 0) {
            const params = {
              name_like: data.search_member,
              name_query: 'fullName',
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

  // PAGINATION
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