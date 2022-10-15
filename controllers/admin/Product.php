<?php

namespace app\controllers\admin;

use app\core\Controller;

class Product extends Controller
{
  public function add()
  {
    $this->view("layoutAdmin", [
      'title' => 'Thêm sản phẩm',
      'page' => 'productAdd',
      'css' => ['admin', 'index'],
      'content' => 'content'
    ]);
  }
}
