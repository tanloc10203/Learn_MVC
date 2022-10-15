<?php

namespace app\controllers\admin;

use app\core\Controller;

class Auth extends Controller
{
  public function login()
  {
    $this->view("layoutAdmin", [
      'title' => 'Đăng nhập',
      'page' => 'login',
      'css' => ['admin', 'index']
    ]);
  }

  public function logout()
  {
  }
}
