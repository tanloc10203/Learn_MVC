<?php

namespace app\controllers\admin;

use app\core\Controller;
use app\models\admin\CategoryModel;

class Category extends Controller
{
  public function index()
  {
    $category = new CategoryModel();

    $data = $category->getAll();

    $this->view("layoutAdmin", [
      'title' => 'Danh mục',
      'page' => 'category',
      'css' => ['admin', 'index', 'toast'],
      'content' => 'contentTable',
      'head_title' => 'Danh sách danh mục',
      'label_add' => 'Thêm danh mục',
      'data_categories' => $data,
      'js' => ['category']
    ]);
  }

  public function add()
  {
    $category = new CategoryModel();

    if ($this->isPost()) {
      $category->loadData($this->getBody());
      $category->validate();

      if (count($category->errors) > 0)
        exit(json_encode([
          'error' => true,
          'message' => 'Error',
          'model' => $category
        ]));

      $category->save();

      $_SESSION['data'] = [
        'message' => 'Thêm thành công',
        'error' => false
      ];

      exit(json_encode([
        'error' => false,
        'message' => 'Success',
        'model' => $category
      ]));
    }

    $this->view("layoutAdmin", [
      'title' => 'Thêm danh mục',
      'page' => 'categoryAdd',
      'css' => ['admin', 'index', 'toast'],
      'content' => 'content',
      'model' => $category,
      'js' => ['category']
    ]);
  }

  public function update($id = 0)
  {
    $category = new CategoryModel();

    $findCategory = $category->findById($id);

    if ($this->isPost()) {
      $category->loadData($this->getBody());
      $category->validate();

      if (count($category->errors) > 0)
        exit(json_encode([
          'error' => true,
          'message' => 'Error',
          'model' => $category
        ]));

      $category->update($this->getBody()['id']);

      $_SESSION['data'] = [
        'message' => 'Cập nhật thành công',
        'error' => false
      ];

      exit(json_encode([
        'error' => false,
        'message' => 'Success',
        'model' => $category,
      ]));
    }

    $this->view("layoutAdmin", [
      'title' => 'Cập nhật danh mục',
      'page' => 'categoryUpdate',
      'css' => ['admin', 'index', 'toast'],
      'content' => 'content',
      'js' => ['category'],
      'model' => $category,
      'category' => $findCategory
    ]);
  }

  public function delete()
  {
    $category = new CategoryModel();

    $data = $category->getAll();

    if ($this->isPost()) {
      $category->loadData($this->getBody());

      $category->delete($this->getBody()['id']);

      $_SESSION['data'] = [
        'message' => 'Xóa thành công',
        'error' => false
      ];
      exit(json_encode(['message' => 'Delete success', 'error' => false]));
    }

    $this->view("layoutAdmin", [
      'title' => 'Danh mục',
      'page' => 'category',
      'css' => ['admin', 'index', 'toast'],
      'content' => 'contentTable',
      'head_title' => 'Danh sách danh mục',
      'label_add' => 'Thêm danh mục',
      'data_categories' => $data,
      'js' => ['category']
    ]);
  }
}
