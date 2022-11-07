<div class="container mt-5">
  <div class="row">
    <div class="col">
      <?php if (isset($params['error']) && !empty($params['error'])) : ?>
        <div class="alert alert-danger"><?= $params['error'] ?></div>
      <?php endif ?>
      <form action="<?= BASE_URL . '/address/change' ?>" method="post">
        <div class="row">

          <div class="form-group col">
            <label for="province">Tỉnh</label>
            <select name="" id="province" class="form-select form-control">
              <option value="" disabled selected>---- Chọn ----</option>
            </select>
          </div>

          <div class="form-group col">
            <label for="district">Huyện</label>
            <select name="" id="district" class="form-select form-control">
              <option value="" disabled selected>---- Chọn ----</option>
            </select>
          </div>

          <div class="form-group col">
            <label for="ward">Xã</label>
            <select name="" id="ward" class="form-select form-control">
              <option value="" disabled selected>---- Chọn ----</option>
            </select>
          </div>

        </div>

        <div class="row">
          <div class="form-group col">
            <label for="ward">Địa chỉ</label>
            <input type="text" class="form-control" name="address" value="<?= isset($params['data']['address']) ? $params['data']['address'] : null ?>">
          </div>

          <div class="form-group col">
            <label for="ward">Số điện thoại</label>
            <input type="text" class="form-control" name="phone" value="<?= isset($params['data']['phone']) ? $params['data']['phone'] : null ?>">
          </div>
        </div>

        <button type="submit" class="btn btn-info">Thay đổi</button>

      </form>
    </div>
  </div>
</div>