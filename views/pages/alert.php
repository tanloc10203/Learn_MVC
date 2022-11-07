<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-8">

      <div class="jumbotron bg-success text-light">
        <h2 class="text-center">Chúc mừng bạn đã đặt hàng thành công</h2>

        <hr class="my-4">

        <ul class="list-group text-dark">
          <?php if (isset($params['data'])) : ?>
            <?php foreach ($params['data'] as $item) : ?>
              <li class="list-group-item">
                <p>Tên sản phẩm: <b><?= $item['name'] ?></b></p>
                <p>Số lượng: &nbsp;<b>x<?= $item['quantity'] ?></b></p>
                <p>Giá: &nbsp;<b><?= number_format($item['price'], 0, '', '.') . 'đ' ?></b></p>
                <p>Tổng giá: <b><?= number_format($item['price'] * $item['quantity'], 0, '', '.') . 'đ' ?></b></p>
              </li>
            <?php endforeach ?>
          <?php endif ?>
        </ul>

        <p class="lead mt-3">
          <a class="btn btn-light" href="<?= BASE_URL . '/' ?>" role="button">Quay về trang chủ</a>
        </p>
      </div>
      <?php if (isset($params['data'])) : ?>

      <?php endif; ?>
    </div>
  </div>
</div>