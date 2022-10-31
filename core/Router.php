<?php

namespace app\core;

use app\core\middleware\Middleware;

class Router
{
  public $controller = 'Home';
  public string $action = 'index';
  public array $params = [];

  public function __construct()
  {
    $this->resolve();
  }

  private function resolve()
  {
    $url_path = self::urlProcess();

    if (is_array($url_path) && file_exists(CONTROLLER_PATH . $url_path[0] . '.php'))
      $this->controller = $url_path[0];
    else header('Location: ./notFound');

    require_once CONTROLLER_PATH . $this->controller . '.php';

    $class = 'app\\controllers\\' . $this->controller;

    $this->controller = new $class;

    if (isset($url_path[1]) && method_exists($this->controller, $url_path[1]))
      $this->action = $url_path[1];

    unset($url_path[0], $url_path[1]);

    $this->params = $url_path ?? [];

    try {
      call_user_func_array([$this->controller, $this->action], $this->params);
    } catch (\Throwable $th) {
      echo $th->getMessage();
    }
  }

  private static function urlProcess()
  {
    if (isset($_GET['url']))
      return explode("/", filter_var(trim($_GET['url'], '/')));
    return ['0' => 'Home'];
  }
}
