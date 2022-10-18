<?php

namespace app\core;

use DateTimeImmutable;

class Controller
{
  protected function model($model)
  {
    if (isset($model) && file_exists(MODEL_PATH . $model . '.php')) {
      $class = "app\\models\\$model";
      return new $class;
    }
    exit("Model not found !");
  }

  protected function view($view, $params = [])
  {
    if (!isset($params['title']) || !isset($params['page']) || !isset($params['css'])) {
      exit("Missing: title or page or css");
    }

    if (file_exists(VIEW_PATH . $view . ".php")) {
      return require_once VIEW_PATH . $view . ".php";
    }

    exit("VIEW NOT FOUND!");
  }

  public function getLayout($nameLayout, $params = [])
  {
    if (file_exists(VIEW_LAYOUTS_PATH . $nameLayout . '.php')) {
      return require_once VIEW_LAYOUTS_PATH . $nameLayout . '.php';
    }

    exit("GET LAYOUT NOT FOUND!");
  }

  public function getPage($namePage, $params = [])
  {
    if (file_exists(VIEW_PAGES_PATH . $namePage . '.php')) {
      return require_once VIEW_PAGES_PATH . $namePage . '.php';
    }

    exit("GET PAGE NOT FOUND!");
  }

  public function getLayoutAdmin($nameLayout, $params = [])
  {
    if (file_exists(VIEW_LAYOUTS_PATH . "admin\\" . $nameLayout . '.php')) {
      return require_once VIEW_LAYOUTS_PATH . "admin\\" . $nameLayout . '.php';
    }

    exit("GET LAYOUT NOT FOUND!");
  }

  public function getComponentAdmin($component, $nameLayout, $params = [])
  {
    if (file_exists(VIEW_COMPONENTS_PATH . "admin\\$component\\$nameLayout.php")) {
      return require_once VIEW_COMPONENTS_PATH . "admin\\$component\\$nameLayout.php";
    }

    exit("GET COMPONENTS NOT FOUND!");
  }

  public function getPageAdmin($namePage, $params = [])
  {
    if (file_exists(VIEW_PAGES_PATH . "admin\\" . $namePage . '.php')) {
      return require_once VIEW_PAGES_PATH . "admin\\" . $namePage . '.php';
    }

    exit("GET PAGE NOT FOUND!");
  }

  protected function getJs($nameFile)
  {
    echo PUBLIC_PATH . "/js/$nameFile.js";
  }

  protected function getCss($nameFile)
  {
    echo PUBLIC_PATH . "/css/$nameFile.css";
  }

  public function method()
  {
    return strtolower($_SERVER['REQUEST_METHOD']);
  }

  public function isGet()
  {
    return $this->method() === 'get';
  }

  public function isPost()
  {
    return $this->method() === 'post';
  }

  public function getBody()
  {
    $body = [];

    if ($this->method() === 'get') {
      foreach ($_GET as $key => $value) {
        $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
      }
    }

    if ($this->method() === 'post') {
      foreach ($_POST as $key => $value) {
        $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
      }
    }

    return $body;
  }

  public function redirect($url = '')
  {
    if (!empty($url))
      return header("Location: .$url");
  }

  protected function processImg($file_name, $tmp_name, $folder_upload)
  {
    // $folder_upload = UPLOAD_PRODUCT_PATH || UPLOAD_USER_PATH;

    if (isset($file_name)) {
      $date = new DateTimeImmutable();

      $file_name_arr = explode(".", $file_name);

      if (isset($file_name_arr[1])) {
        $img = rand(0, $date->getTimestamp()) . "." . $file_name_arr[1];

        $target_file = $folder_upload . basename($img);

        if (move_uploaded_file($tmp_name, $target_file))
          return $img;
      }

      return "";
    }
  }
}
