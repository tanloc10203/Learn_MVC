<div class="container mt-5 pb-5">
  <div class="row">
    <div class="col-12">
      <?php if (isset($params['head_title'])) : ?>
        <h5><?= htmlspecialchars($params['head_title']) ?></h5>
      <?php endif ?>

      <div class="row mb-5">
        <div class="col-4">
          <a href="<?= BASE_URL . "\\admin\\" . $params['page'] . '\\add' ?>" class="btn btn-success">
            <?= $params['label_add'] ?? 'Thêm sản phẩm' ?>
          </a>
        </div>

        <?php $this->getComponentAdmin('form', $params['component']['form']['name'], $params) ?>
      </div>

      <?php $this->getPageAdmin($params['page'], $params) ?>

      <?php $this->getComponentAdmin('pagination', $params['component']['pagination']['name'], $params) ?>
    </div>
  </div>
</div>