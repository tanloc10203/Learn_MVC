<?php

namespace app\controllers;

use app\core\Controller;

class Home extends Controller
{

  public function index()
  {
    $model = $this->model("HomeModel");

    $this->view("layoutMaster", [
      'page' => 'home',
      'array' => $model->get(),
      'color' => 'red'
    ]);
  }
}
