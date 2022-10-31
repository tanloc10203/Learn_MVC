<?php

namespace app\controllers\admin;

use app\core\Controller;
use app\models\admin\CategoryModel;
use app\models\admin\ProductModel;

class Product extends Controller
{
  public function add()
  {
    $product = new ProductModel();
    $categories = new CategoryModel();

    if ($this->isPost()) {
      $img = '';

      if ($_FILES['thumb']) {
        $product->thumb = $_FILES['thumb']['name'];
        $img = $this->processImg($_FILES['thumb']['name'], $_FILES['thumb']['tmp_name'], UPLOAD_PRODUCT_PATH);
      }

      $data = $this->getBody();
      $data['thumb'] = $img;

      $product->loadData($data);
      $product->validate();

      if (count($product->errors) > 0)
        exit(json_encode([
          'error' => true,
          'message' => 'Error validate',
          'model' => $product
        ]));

      $product->save();

      $_SESSION['data'] = [
        'message' => 'Thêm sản phẩm thành công',
        'error' => false
      ];

      exit(json_encode([
        'error' => false,
        'message' => 'Success',
        'model' => $product
      ]));
    }

    $this->view("layoutAdmin", [
      'title' => 'Thêm sản phẩm',
      'page' => 'productAdd',
      'css' => ['admin', 'index', 'input', 'member'],
      'js' => ['input', 'product'],
      'content' => 'content',
      'model' => $product,
      'categories' => $categories->getAll(),
    ]);
  }

  public function update()
  {
    $model = new ProductModel();
    $categories = new CategoryModel();

    $id = '';
    if (isset($_GET['id']))
      $id = $_GET['id'];

    $product = $model->findById((int)$id);

    if ($this->isPost()) {
      $data = $this->getBody();

      $img = '';

      if (isset($_FILES['thumb'])) {
        $model->thumb = $_FILES['thumb']['name'];
        $img = $this->processImg($_FILES['thumb']['name'], $_FILES['thumb']['tmp_name'], UPLOAD_USER_PATH);
      }

      if (!empty($img)) $data['thumb'] = $img;

      $model->loadData($data);
      $attributes = $model->attributes();
      $rules = array();

      $attributes = array_filter($attributes, function ($val) use ($model) {
        return !empty($model->{$val});
      });

      foreach ($attributes as $attr) {
        $rules[$attr] = $model->rules()[$attr];
      }

      $model->validate($rules);

      if (count($model->errors) > 0)
        exit(json_encode([
          'error' => true,
          'message' => 'Error validate',
          'model' => $model
        ]));

      $model->update($id);

      $_SESSION['data'] = [
        'message' => 'Cập nhật thành công',
        'error' => false
      ];

      exit(json_encode([
        'error' => false,
        'message' => 'Success',
        'model' => $model,
      ]));
    }

    $this->view("layoutAdmin", [
      'title' => 'Cập nhật sản phẩm',
      'page' => 'productUpdate',
      'css' => ['admin', 'index', 'member', 'input'],
      'content' => 'content',
      'js' => ['input', 'product'],
      'model' => $model,
      'product' => $product,
      'categories' => $categories->getAll(),
    ]);
  }

  public function delete()
  {
    $id = '';

    if (isset($_GET['id']))
      $id = $_GET['id'];

    if ($this->isPost()) {
      $product = new ProductModel();

      $product->delete($id);

      exit(json_encode(['message' => 'Delete success', 'error' => false]));
    }
  }

  public function search()
  {
    if ($this->isPost()) {
      exit(json_encode(['message' => 'SEND DATA', 'data' => $this->getBody()]));
    }
  }

  public function pagination()
  {
    $page = "";

    if (isset($_GET['page'])) $page = $_GET['page'];

    if ($page === 'next')
      exit(json_encode(['page' => 'next']));
    else if ($page === 'prev')
      exit(json_encode(['page' => 'prev']));

    echo json_encode(['page' => (int)$page]);
  }
}
