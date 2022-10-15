<?php

use app\core\forms\Form;

$form = new Form();
?>

<div class="container mt-4">
  <div class="row">
    <div class="col-12">
      <h4 class="text-center text-primary mb-4">Thêm danh mục</h4>

      <?php $form::begin(BASE_URL . "/admin/category/add", "post", "categoryAdd") ?>

      <?= $form->field($params['model'], 'name') ?>

      <button type="submit" class="btn btn-primary">Thêm</button>

      <?= $form::end() ?>
    </div>
  </div>
</div>