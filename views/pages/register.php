<?php

use app\core\forms\Form;

$form = new Form();
?>

<div class="container">
  <div class="row">
    <div class="col">
      <h1 class="text-center">Register</h1>

      <div class="form-login">
        <?php $form::begin(BASE_URL . '/register', 'post', 'form_login') ?>

        <?= $form->field($params['model'], 'fullName') ?>

        <?= $form->field($params['model'], 'username') ?>

        <?= $form->field($params['model'], 'password')->passwordField() ?>


        <button type="submit" class="btn btn-primary">Đăng ký</button>

        <?= $form::end() ?>
      </div>
    </div>
  </div>
</div>