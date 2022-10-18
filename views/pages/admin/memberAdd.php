<?php

use app\core\forms\Form;

$form = new Form();
?>

<div class="container mt-5 pb-5">
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
          <?= $form->field($params['model'], 'phone')->numberField() ?>
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
          <?= $form->field($params['model'], 'group_id') ?>
        </div>
      </div>

      <?= $form->field($params['model'], 'thumb')->fileField() ?>

      <button type="submit" class="btn btn-primary">Lưu</button>

      <?php $form::end() ?>

    </div>
  </div>
</div>