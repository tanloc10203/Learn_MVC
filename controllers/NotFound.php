<?php

class NotFound extends Controller
{
  public function index()
  {
    $this->view("layoutMasterNotFound", [
      'page' => '_404',
    ]);
  }
}
