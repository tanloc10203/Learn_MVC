<div class="main-page">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <!-- LIST PRODUCT -->
        <div class="row products mt-5">

          <?php if (isset($params['products'])) : ?>
            <?php foreach ($params['products'] as $item) : ?>

              <form action="<?= BASE_URL . "/cart/add" ?>" method="post" id="add_form" class="mb-2 products__response col-sm-6 col-xs-6 col-md-4 col-lg-3">
                <div class="card products-item">

                  <img src="<?= PUBLIC_PATH_PRODUCT_UPLOAD . $item['thumb'] ?>" alt="Iphone" class="card-img-top products__img" />

                  <input type="text" value="<?= $item['id'] ?>" name="p_id" hidden>

                  <div class="card-body products-body">
                    <h4 class="card-title products__name"><?= $item['name'] ?></h4>

                    <div class="form-group">
                      <label for="quantity">Số lượng</label>
                      <input type="number" class="form-control" name="quantity" value="1" min="1" max="10">
                    </div>

                    <div class="products__info">
                      <div class="products__price"><?= number_format($item['price'], 0, '', '.') ?><span class="products__unit">đ</span></div>
                      <button type="submit" class="card-link products__add-to-cart">
                        <i class="fa-solid fa-cart-plus"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </form>

            <?php endforeach ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>