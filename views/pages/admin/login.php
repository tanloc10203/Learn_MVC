<?php

use app\core\forms\Form;

$form = new Form();
?>

<div class="container">
  <div class="row">
    <div class="col">
      <h1 class="text-center">Login</h1>

      <div class="form-login">
        <?php $form::begin(BASE_URL . '/auth/login', 'post', 'form-login') ?>

        <?= $form->field($params['model'], 'username') ?>

        <?= $form->field($params['model'], 'password')->passwordField() ?>

        <button type="submit" class="btn btn-primary">Đăng nhập</button>

        <?= $form::end() ?>
      </div>
    </div>
  </div>
</div>