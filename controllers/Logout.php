<?php

namespace app\controllers;

use app\core\Controller;

class Logout extends Controller
{

  public function index()
  {
    unset($_SESSION['user_client']);
    $this->redirect(BASE_URL . '/login');
  }
}
