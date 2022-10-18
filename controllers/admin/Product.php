<?php

namespace app\controllers\admin;

use app\core\Controller;
use app\models\admin\ProductModel;

class Product extends Controller
{
  public function add()
  {
    $product = new ProductModel();

    $this->view("layoutAdmin", [
      'title' => 'Thêm sản phẩm',
      'page' => 'productAdd',
      'css' => ['admin', 'index'],
      'content' => 'content',
      'model' => $product,
    ]);
  }
}
