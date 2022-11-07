.<div class="container mt-5">
  <div class="row">
    <div class="col">

      <table class="table table-hover">
        <thead>
          <tr class="bg-success text-white">
            <th scope="col">ID Bill</th>
            <th scope="col">Tên sản phẩm</th>
            <th scope="col">Số lượng</th>
            <th scope="col">Tổng giá</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Ngày mua</th>
          </tr>
        </thead>
        <tbody>
          <?php if (isset($params['bills']) && count($params['bills']) > 0) : ?>
            <?php foreach ($params['bills'] as $item) : ?>
              <tr>

                <td><?= $item['id_bill']; ?></td>
                <td><span class="cut-name"><?= $item['product_name']; ?></span></td>
                <td><?= $item['quantity']; ?></td>
                <td><?= number_format($item['quantity'] * $item['price'], 0, '', '.') . 'đ' ?></td>
                <td>
                  <span class="<?= $this->getColorByStatusId($item['status_id']) ?>"><?= $item['status_name']; ?></span>
                </td>
                <td>
                  <?= $item['created_at'] ?>
                </td>
              </tr>
            <?php endforeach ?>
          <?php endif ?>
        </tbody>
      </table>


    </div>
  </div>
</div>