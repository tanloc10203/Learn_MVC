<?php

use app\core\forms\Form;

$form = new Form();
?>

<div class="container mt-4">
  <div class="row">
    <div class="col-12">

      <?php $form::begin(BASE_URL . "/admin/product/add", "post", "add_product") ?>

      <?= $form->field($params['model'], 'name') ?>

      <?= $form->field($params['model'], 'price')->numberField() ?>

      <?= $form->field($params['model'], 'description') ?>

      <?= $form->field($params['model'], 'thumb') ?>

      <button type="submit" class="btn btn-primary">Lưu</button>

      <?php $form::end() ?>

    </div>
  </div>
</div>