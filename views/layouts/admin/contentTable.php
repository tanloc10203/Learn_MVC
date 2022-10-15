<div class="container mt-5">
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

        <form class="form-inline ml-auto">
          <input class="form-control mr-sm-1" type="search" placeholder="Tim kiếm" aria-label="Search">
          <button class="btn btn-outline-success my-sm-0" type="submit">Tìm kiếm</button>
        </form>
      </div>

      <?php $this->getPageAdmin($params['page'], $params); ?>

      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
              <span class="sr-only">Previous</span>
            </a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
              <span class="sr-only">Next</span>
            </a>
          </li>
        </ul>
      </nav>

    </div>
  </div>
</div>