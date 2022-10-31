<?php

namespace app\controllers;

use app\controllers\admin\Auth;
use app\controllers\admin\Category;
use app\controllers\admin\Member;
use app\controllers\admin\Product;
use app\controllers\admin\Profile;
use app\core\Controller;
use app\models\admin\ProductModel;

class Admin extends Controller
{
  public function index()
  {
    if ($this->isPost()) {
      $product = new ProductModel();

      $product->loadData($this->getBody());

      $data = $product->getAll($this->getBody());

      $total = $product->count();

      $total_row = ceil($total / (int) $this->getBody()['limit']);

      exit(json_encode([
        'message' => 'GET ALL SUCCESS',
        'data' => $data,
        'total_rows' => $total_row,
        'path_img' => PUBLIC_PATH_PRODUCT_UPLOAD
      ]));
    }

    $this->view("layoutAdmin", [
      'title' => 'Dashboard',
      'page' => 'product',
      'css' => ['admin', 'index'],
      'js' => ['product'],
      'content' => 'contentTable',
      'head_title' => 'Danh sách sản phẩm',
      'component' => [
        'form' => ['name' => 'product'],
        'pagination' => ['name' => 'product']
      ]
    ]);
  }

  public function product($params = '')
  {
    $product = new Product();

    if (!empty($params))
      return $product->$params();

    return $this->index();
  }

  public function category($params = '', $id = 0)
  {
    $category = new Category();

    if ($params === 'add')
      return $category->add();

    if ($params === 'update')
      return $category->update($id);

    if ($params === 'delete')
      return $category->delete();

    if ($params === 'search')
      return $category->search();

    if ($params === 'pagination')
      return $category->pagination($id);

    return $category->index();
  }

  public function login()
  {
    (new Auth())->login();
  }

  public function logout()
  {
    (new Auth())->logout();
  }

  public function profile($params = '')
  {
    $profile = new Profile();

    if ($params === 'add')
      return $profile->add();

    return $profile->index();
  }

  public function member($params = '')
  {
    $member = new Member();

    if (!empty($params))
      return $member->$params();

    return $member->index();
  }
}
