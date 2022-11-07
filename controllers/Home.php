<?php

namespace app\controllers;

use app\core\Controller;
use app\models\admin\CategoryModel;
use app\models\admin\ProductModel;

class Home extends Controller
{
  private ProductModel $products;
  private CategoryModel $category;

  public function __construct()
  {
    $this->products = new ProductModel;
    $this->category = new CategoryModel;
  }

  public function index()
  {

    if ($this->isPost()) {
      $data = $this->getBody();
      $results =  $this->products->getAllClient([
        'cat_id' => $data['cat_id'] ?? '',
        'key_name' => $data['key_name'] ?? '',
      ]);
      $url_img = PUBLIC_PATH_PRODUCT_UPLOAD;
      $action = BASE_URL . '/cart/add';

      exit(json_encode(array(
        'results' => $results,
        'url_img' => $url_img,
        'action' => $action,
      )));
    }

    $this->view("layoutMaster", [
      'page' => 'home',
      'title' => 'Trang chủ',
      'css' => ['index'],
      'categories' => $this->category->getAll(),
      'js' => ['cart', 'home']
    ]);
  }
}
