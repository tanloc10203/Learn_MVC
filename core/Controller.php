<?php

class Controller
{
  protected function model($model)
  {
    if (isset($model) && file_exists(MODEL_PATH . $model . '.php'))
      return new $model;
    exit("Model not found");
  }

  protected function view($view, $params = [])
  {
    require_once VIEW_PATH . "$view.php";
  }

  protected function getHeader($header)
  {
    if (isset($header) && file_exists(VIEW_LAYOUTS_PATH . $header . '.php'))
      return require_once VIEW_LAYOUTS_PATH . $header . '.php';
    exit("Header not found");
  }

  protected function getFooter($footer)
  {
    if (isset($footer) && file_exists(VIEW_LAYOUTS_PATH . $footer . '.php'))
      return require_once VIEW_LAYOUTS_PATH . $footer . '.php';
    exit("Footer not found");
  }

  protected function getPage($page, $params = [])
  {
    if (isset($page) && file_exists(VIEW_PAGES_PATH . $page . '.php'))
      return require_once VIEW_PAGES_PATH . $page . '.php';
    exit("Page not found");
  }
}
