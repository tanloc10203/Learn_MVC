<?php

use app\core\forms\Form;
use app\core\forms\SelectField;

$form = new Form();
$select = new SelectField($params['model'], 'category_id');
?>

<div class="container mt-4">
  <div class="row">
    <div class="col-12">

      <?php $form::begin(BASE_URL . "/admin/product/add", "post", "add_product") ?>

      <?= $form->field($params['model'], 'name') ?>

      <?= $form->field($params['model'], 'price') ?>

      <div class="form-group">
        <label for="group_id">Danh mục</label>

        <?= $select->select_start(); ?>

        <?= $select->renderOptionFirst("----- Chọn danh mục -----") ?>

        <?php if (isset($params['categories']) && is_array($params['categories'])) : ?>
          <?php foreach ($params['categories'] as $option) : ?>

            <?= $select->renderOption($option['id'], $option['name']) ?>

          <?php endforeach ?>
        <?php endif ?>

        <?= $select->select_end(); ?>

        <?= $select->renderErrSelect() ?>
      </div>

      <?= $form->field($params['model'], 'thumb', true)->fileField() ?>

      <div class="d-inline-block img-member">
        <label for="thumb" class="form-label w-100">
          <div class="rounded bg-black border bg-secondary h-100" id="show-img">
            <i class="fa-sharp fa-solid fa-image"></i>
          </div>
        </label>
      </div>

      <button type="submit" class="btn btn-primary d-block">Lưu</button>

      <?php $form::end() ?>

    </div>
  </div>
</div>