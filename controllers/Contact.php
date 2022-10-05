<?php

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
