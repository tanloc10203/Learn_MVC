<?php

use app\core\forms\Form;

$form = new Form();
?>

<?php $form::begin(BASE_URL . '/checkout', 'post', '') ?>
<div class="container mt-5">
  <div class="row">
    <div class="col-5">
      <h4>Thông tin khách hàng</h4>
      <?php if (isset($_SESSION['error'])) : ?>
        <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
        <?php unset($_SESSION['error']) ?>
      <?php endif ?>

      <?php if (isset($params['user'])) : ?>
        <div class="mt-4">
          <p>Họ và tên: <b><?= $params['user']['fullName'] ?></b></p>
          <p>Số điện thoại: <b><?= $params['user']['phone'] ?></b></p>
          <p>Địa chỉ: <b><?= $params['user']['address'] ?></b></p>

          <input type="text" name='fullName' value="<?= $params['user']['fullName'] ?>" hidden>
          <input type="text" name="phone" value="<?= $params['user']['phone'] ?>" hidden>
          <input type="text" name="address" value="<?= $params['user']['address'] ?>" hidden>

          <a href="<?= BASE_URL . '/address/change' ?>" class="btn btn-info">Thay đổi địa chỉ</a>
        </div>
      <?php endif ?>
    </div>

    <div class="col-7">
      <h4>Thông tin đơn hàng</h4>

      <div class="mt4">
        <?php if (isset($params['cart']) && count($params['cart']) > 0) : ?>
          <ul class="list-group">
            <?php foreach ($params['cart']['buy'] as $item) : ?>
              <li class="list-group-item d-flex justify-content-between">
                <div class="left-content d-flex">
                  <p class="text-cut m-0"><?= $item['name'] ?></p>
                  <b>x<?= $item['quantity'] ?></b>
                </div>
                <div class="right-content">
                  <?= number_format($item['price'], 0, '', '.') . 'đ' ?>
                </div>
              </li>
            <?php endforeach ?>

            <h3 class="mt-3 mb-5 text-right">Tổng giá&nbsp; <b class="text-danger"><?= number_format($params['cart']['info']['total'], 0, '', '.') . 'đ' ?></b></h3>

            <p>Hình thức thanh toán:</p>
            <p> -<b>Thanh toán khi nhận hàng</b></p>
            <button type="submit" class="btn btn-info">Đặt hàng</button>
          </ul>
        <?php endif ?>
      </div>
    </div>
  </div>
</div>
<?php $form::end() ?>