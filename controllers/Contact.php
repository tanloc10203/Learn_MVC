<?php

namespace app\controllers;

use app\core\Controller;

class Contact extends Controller
{
  public function index()
  {
    $this->view("layoutMaster", [
      'page' => 'contact',
      'array' => ['text' => 'Hello', 'color' => 'red'],
    ]);
  }
}
