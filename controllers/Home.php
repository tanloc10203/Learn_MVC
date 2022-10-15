<?php

namespace app\controllers;

use app\core\Controller;

class Home extends Controller
{

  public function index()
  {
    $this->view("layoutMaster", [
      'page' => 'home',
      'title' => 'Trang chủ',
      'css' => ['index'],
    ]);
  }
}
