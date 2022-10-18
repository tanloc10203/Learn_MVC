<?php

namespace app\controllers\admin;

use app\core\Controller;
use app\models\admin\UserModel;

class Member extends Controller
{
  public function index()
  {
    $this->view("layoutAdmin", [
      'title' => 'Thành viên',
      'page' => 'member',
      'css' => ['admin', 'index'],
      'content' => 'contentTable',
      'head_title' => 'Danh sách thành viên',
      'label_add' => 'Thêm thành viên',
      'component' => [
        'form' => ['name' => 'member'],
        'pagination' => ['name' => 'member'],
      ]
    ]);
  }

  public function add()
  {
    $model = new UserModel();

    if ($this->isPost()) {
      $data = $this->getBody();

      // $model->loadData();
      // $model->validate();

      echo "<pre>";
      print_r($_FILES);
      exit;
    }

    $this->view("layoutAdmin", [
      'title' => 'Thêm thành viên',
      'page' => 'memberAdd',
      'css' => ['admin', 'index'],
      'content' => 'content',
      'model' => $model
    ]);
  }
}
