<?php

namespace app\controllers;

use app\core\Controller;
use app\models\admin\ProductModel;

class Home extends Controller
{
  private ProductModel $products;

  public function __construct()
  {
    $this->products = new ProductModel;
  }

  public function index()
  {
    $this->view("layoutMaster", [
      'page' => 'home',
      'title' => 'Trang chủ',
      'css' => ['index'],
      'products' => $this->products->getAll(),
      'js' => ['cart']
    ]);
  }
}
