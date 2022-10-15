<?php

namespace app\controllers\admin;

use app\core\Controller;

class Profile extends Controller
{
  public function index()
  {
    $this->view("layoutAdmin", [
      'title' => 'Thông tin cá nhân',
      'page' => 'profile',
      'css' => ['admin', 'index']
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
