<?php

use app\core\forms\Form;
use app\core\forms\SelectField;

$form = new Form();
$select = new SelectField($params['model'], 'group_id');

if (isset($params['member'])) {
  $params['model']->fullName = $params['member']['fullName'];
  $params['model']->username = $params['member']['username'];
  $params['model']->phone = $params['member']['phone'];
  $params['model']->email = $params['member']['email'];
  $params['model']->thumb = $params['member']['thumb'];
  $params['model']->group_id = $params['member']['group_id'];
}

?>

<div class="container mt-5" style="padding-bottom: 100px;">
  <div class="row">
    <div class="col-12">
      <h4 class="text-center text-primary mb-4">Thêm thành viên</h4>

      <?php $form::begin(BASE_URL . '/admin/member/update?id=' . $params['member']['id'], "post", "add_member") ?>

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
          <?= $form->field($params['model'], 'email')->emailField() ?>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-6">
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
            <?php if (isset($params['member']['thumb'])) : ?>
              <img class="img-thumbnail" src="<?= PUBLIC_PATH_USER_UPLOAD . $params['member']['thumb'] ?>" alt="">
            <?php endif ?>
          </div>
        </label>
      </div>

      <button type="submit" class="btn btn-primary mt-2 d-block">Lưu</button>

      <?php $form::end() ?>

    </div>
  </div>
</div>