<?php

use app\core\forms\Form;
use app\core\forms\SelectField;

$form = new Form();
$select = new SelectField($params['model'], 'group_id');
?>

<div class="container mt-5" style="padding-bottom: 100px;">
  <div class="row">
    <div class="col-12">
      <h4 class="text-center text-primary mb-4">Thêm thành viên</h4>

      <?php $form::begin(BASE_URL . "/admin/member/add", "post", "add_member") ?>

      <div class="row">
        <div class="col">
          <?= $form->field($params['model'], 'fullName') ?>
        </div>

        <div class="col">
          <?= $form->field($params['model'], 'username') ?>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <?= $form->field($params['model'], 'phone') ?>
        </div>

        <div class="col">
          <?= $form->field($params['model'], 'password')->passwordField() ?>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <?= $form->field($params['model'], 'email')->emailField() ?>
        </div>

        <div class="col">
          <label for="group_id">Chọn nhóm quyền</label>

          <?= $select->select_start(); ?>

          <?= $select->renderOptionFirst("-----Chọn quyền-----") ?>

          <?php if (isset($params['array_group_roles']) && is_array($params['array_group_roles'])) : ?>
            <?php foreach ($params['array_group_roles'] as $option) : ?>

              <?= $select->renderOption($option['id'], $option['role']) ?>

            <?php endforeach ?>
          <?php endif ?>

          <?= $select->select_end(); ?>

          <?= $select->renderErrSelect() ?>
        </div>
      </div>

      <?= $form->field($params['model'], 'thumb', true)->fileField() ?>

      <div class="d-inline-block img-member">
        <label for="thumb" class="form-label w-100">
          <div class="rounded bg-black border bg-secondary h-100" id="show-img">
            <i class="fa-sharp fa-solid fa-image"></i>
          </div>
        </label>
      </div>

      <button type="submit" class="btn btn-primary mt-2 d-block">Lưu</button>

      <?php $form::end() ?>

    </div>
  </div>
</div>