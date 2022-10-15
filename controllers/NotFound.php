<?php

namespace app\controllers;

use app\core\Controller;

class NotFound extends Controller
{
  public function index()
  {
    $this->view("layoutMasterNotFound", [
      'page' => '_404',
      'title' => 'Page not found',
      'css' => 'notFound'
    ]);
  }
}
