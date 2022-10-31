<?php

use app\core\forms\Form;

$form = new Form();
?>

<?php $form::begin(BASE_URL . "/admin/product/search", "post", "search", 'form-inline ml-auto') ?>

<input class="form-control mr-sm-1" type="search" name="search_product" placeholder="Tim kiếm" aria-label="Search">

<button class="btn btn-outline-success my-sm-0" type="submit">Tìm kiếm</button>

<?php $form->end() ?>