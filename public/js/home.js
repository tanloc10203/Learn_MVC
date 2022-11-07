$(document).ready(function () {
  $(document).on('change', '#form-select', function (e) {
    if (!e.target.value) {
      getAll();
    } else {
      getAll({ cat_id: +e.target.value })
    }
  });

  let debounce;

  $(document).on('keyup chang', 'input[name="key_name"]', (e) => {
    clearTimeout(debounce);

    if (e.target.value !== '') {
      debounce = setTimeout(() => {
        getAll({ key_name: e.target.value });
      }, 500)
    } else {
      getAll();
    }
  })

  const input_hidden = $('input[type="hidden"]')

  if (input_hidden) getAll();

  function getAll(params = {}) {
    console.log(params);


    $.ajax({
      url: window.location.href,
      method: 'post',
      data: params,
      dataType: 'json',
      beforeSend: function () {
        $("#overlay").fadeIn();
      },
      success: (response) => {
        $("#overlay").fadeOut();
        $('.products').empty();
        if (response && response.results && response.results.length > 0) {
          const product_item = `${response.results.map(i => (
            `
            <form action="${response.action}" method="post" id="add_form" class="mb-2 products__response col-sm-6 col-xs-6 col-md-4 col-lg-3">
              <div class="card products-item">

                <img src="${response.url_img + i.thumb}" alt="Iphone" class="card-img-top products__img" />

                <input type="text" value="${i.id}" name="p_id" hidden>

                <div class="card-body products-body">
                  <h4 class="card-title products__name">${i.name}</h4>

                  <div class="form-group">
                    <label for="quantity">Số lượng</label>
                    <input type="number" class="form-control" name="quantity" value="1" min="1" max="10">
                  </div>

                  <div class="products__info">
                    <div class="products__price">${format_price(i.price)}</div>
                    <button type="submit" class="card-link products__add-to-cart">
                      <i class="fa-solid fa-cart-plus"></i>
                    </button>
                  </div>
                </div>
              </div>
            </form>
            `
          )).join('')}`;

          $('.products').append(product_item);
        } else {
          $('.products').append('Không có sản phẩm nào');
        }
      },
      error: (e) => {
        $("#overlay").fadeOut();
        console.log(e.responseText)
      }
    })
  }
})