$(document).ready(function () {
  const url = window.location.href;

  $(document).on("submit", "#add_form", function (e) {
    e.preventDefault();
    const action = this.action;

    $.ajax({
      type: 'post',
      url: action,
      dataType: 'json',
      data: new FormData(this),
      processData: false,
      contentType: false,
      beforeSend: () => {
        $("#overlay").fadeIn();
      },
      success: ({ error, data, message, bill }) => {
        $("#overlay").fadeOut();
        if (!error) {
          if (bill && Object.keys(bill).length > 0) {
            $('.header-wp__num-cart').empty();
            $('.header-wp__num-cart').text(bill.num_order);

            toast({
              title: 'Success',
              message: 'Thêm gio hàng thành công',
              type: 'success',
              duration: 3000
            });
          }
        } else {
          toast({
            title: 'Error',
            message: message,
            type: 'error',
            duration: 3000
          });
        }
      },
      error: (e) => {
        $("#overlay").fadeOut();
        console.log("Oops! Something went wrong! ", e.responseText);

        toast({
          title: 'Error',
          message: e.responseText,
          type: 'error',
          duration: 3000
        })
      }
    })
  });

  function handleGetCart() {
    let action = this.location.href;

    $.ajax({
      type: 'post',
      url: action,
      dataType: 'json',
      // data: new FormData(this),
      processData: false,
      contentType: false,
      beforeSend: () => {
        $("#overlay").fadeIn();
      },
      success: ({ data_cart, data_cart_info, path_img, base_url }) => {
        $("#overlay").fadeOut();
        $('.cart').empty();
        $('.total').empty();
        $('.header-wp__num-cart').empty();

        if (data_cart && data_cart.length > 0) {

          const cartItem = `
            ${data_cart.map(item => (
            `
              <div class="cart-list">
                <div class="cart-list__product--info">
                  <img src="${path_img + item.thumb}" alt='' title='' class="cart-list__product-img" />
                  <span class="cart-list__name" title=''>${item.name}</span>
                </div>
                <div class="cart-list__product--content">
                  <div class="cart-list__price">
                    <span class="cart-list__price-head">Giá</span>
                    <div>${format_price(item.price)}</div>
                  </div>
                  <div class="cart-list__number">
                    <span class="cart-list__price-head">Số lượng</span>
                    <form action='${base_url + '/cart/updateQuantity'}' method='post' id=''>
                      <input type="number" class="form-control" name="quantity" id="quantity" value="${item.quantity}" min="1" max="10">
                      <input type='text' name='p_id' hidden value='${item.id}'>
                    </form>
                  </div>
                  <div class="cart-list__total">
                    <span class="cart-list__price-head">Tổng giá</span>
                    <div class="cart-list__total-price">${format_price(item.sub_total)}</div>
                  </div>
                  <div class="cart-list__delete" title="Xóa sản phẩm" data-id='${item.id}'>
                    <i class="fa-solid fa-trash"></i>
                  </div>
                </div>
              </div>
              `
          )).join('')}
          `;

          const total = `
            <div class="row w-100">
              <div class="col-lg-12 col-xs-12">
                <div class="total__content">
                  <div class="total__price">
                    <span>Tổng</span>
                    <div class="total__number">${format_price(data_cart_info.total)}</div>
                  </div>
                  <div>
                    <div class="btn btn-warning total__btn">Thanh toán</div>
                  </div>
                </div>
              </div>
            </div>
          `


          $('.total').append(total);
          $('.header-wp__num-cart').text(data_cart_info.num_order);
          $('.cart').append(cartItem);
        } else {
          $('.header-wp__num-cart').text(0);
          $('.cart').append("Không có sản phẩm trong giỏ hàng. Bạn hãy mua hàng tiếp.");
        }
      },
      error: (e) => {
        $("#overlay").fadeOut();
        console.log("Oops! Something went wrong! ", e.responseText);

        toast({
          title: 'Error',
          message: e.responseText,
          type: 'error',
          duration: 3000
        })
      }
    });

  }

  if (url === 'http://localhost/ManageStudent/cart' || url === 'http://localhost/ManageStudent/cart/') {
    handleGetCart();
  }

  $(document).on('click', '#quantity', function () {

    const parent = $(this).parent();

    const data = new FormData(parent[0]);

    const action = parent[0].action;

    $.ajax({
      type: 'post',
      url: action,
      dataType: 'json',
      data: data,
      processData: false,
      contentType: false,
      beforeSend: () => {
        // $("#overlay").fadeIn();
      },
      success: (response) => {
        handleGetCart();
      },
      error: (e) => {
        // $("#overlay").fadeOut();
        console.log("Oops! Something went wrong! ", e.responseText);

        toast({
          title: 'Error',
          message: e.responseText,
          type: 'error',
          duration: 3000
        })
      }
    });

  });

  $(document).on('click', '.cart-list__delete', function () {
    const action = this.baseURI + '/delete';

    $.post(action, { id: $(this).attr('data-id') }, function (response) {
      // console.log(response);
      handleGetCart();
    }, 'json').fail(function (error) {
      toast({
        title: 'Error',
        message: error.responseText,
        type: 'error',
        duration: 3000
      })
    });
  })
})