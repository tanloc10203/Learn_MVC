<?php

use app\core\forms\Form;

$form = new Form();

if (isset($params['category']))
  $params['model']->name = $params['category']['name'];
?>

<div class="container mt-4">
  <div class="row">
    <div class="col-12">
      <h4 class="text-center text-primary mb-4">Cập nhật danh mục</h4>

      <?php $form::begin(BASE_URL . "/admin/category/update", "post", "categoryAdd") ?>

      <?= $form->field($params['model'], 'name') ?>

      <input type="hidden" name="id" value="<?= htmlspecialchars($params['category']['id']) ?>">

      <button type="submit" class="btn btn-primary">Cập nhật</button>

      <?= $form::end() ?>
    </div>
  </div>
</div>