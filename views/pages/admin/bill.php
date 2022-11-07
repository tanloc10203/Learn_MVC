<div class="container-fluid mt-5">
  <div class="row">
    <div class="col">

      <table class="table table-hover">
        <thead>
          <tr class="bg-success text-white">
            <th scope="col">ID Bill</th>
            <th scope="col">Tên sản phẩm</th>
            <th scope="col">Tên Khách hàng</th>
            <th scope="col">Số lượng</th>
            <th scope="col">Tổng giá</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php if (isset($params['bills']) && count($params['bills']) > 0) : ?>
            <?php foreach ($params['bills'] as $item) : ?>
              <tr>

                <td><?= $item['id_bill']; ?></td>
                <td><span class="cut-name"><?= $item['product_name']; ?></span></td>
                <td><?= $item['customer_name']; ?></td>
                <td><?= $item['quantity']; ?></td>
                <td><?= number_format($item['quantity'] * $item['price'], 0, '', '.') . 'đ' ?></td>
                <td>
                  <span class="<?= $this->getColorByStatusId($item['status_id']) ?>"><?= $item['status_name']; ?></span>
                </td>
                <td>
                  <form method="post" action="<?= BASE_URL . '/admin/bill/update' ?>">
                    <input type="text" value="<?= $item['status_id'] ?>" name="status_id" hidden>
                    <input type="text" value="<?= $item['id_bill'] ?>" name="id" hidden>
                    <button <?= $item['status_id'] == 3 || $item['status_id'] == 4 ? 'disabled' : null ?> type="submit" class="btn btn-outline-info btn-size-small">Xác nhận</button>
                  </form>
                </td>
              </tr>
            <?php endforeach ?>
          <?php endif ?>
        </tbody>
      </table>


    </div>
  </div>
</div>