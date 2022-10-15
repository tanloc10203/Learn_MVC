<?php

namespace app\controllers\admin;

use app\core\Controller;

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
    ]);
  }

  public function add()
  {
    $this->view("layoutAdmin", [
      'title' => 'Thêm thành viên',
      'page' => 'memberAdd',
      'css' => ['admin', 'index'],
      'content' => 'content'
    ]);
  }
}
