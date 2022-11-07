<div class="main-page">
  <div class="container">
    <div class="row">
      <div class="col-12">

        <input type="hidden" name="get_all">

        <div class="row mt-3">
          <div class="col-4 p-0">
            <select name="" id="form-select" class="form-control">
              <option value="">Tất cả</option>
              <?php if (isset($params['categories'])) : ?>
                <?php foreach ($params['categories'] as $item) : ?>
                  <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                <?php endforeach ?>
              <?php endif ?>
            </select>
          </div>

          <div class="col-4">
            <input type="text" class="form-control" name="key_name" placeholder="Tìm kiểm sản phẩm">
          </div>

          <div class="col-4">
            <div class="btn btn-danger">Làm lại</div>
          </div>
        </div>
        <!-- LIST PRODUCT -->
        <div class="row products mt-2"></div>
      </div>
    </div>
  </div>
</div>