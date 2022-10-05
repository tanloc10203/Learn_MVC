<?php

class Application
{
  private $controller = "home";
  private $action = "index";
  private array $params = [];

  public function __construct()
  {
    $url_path = self::urlProcess();

    if (is_array($url_path) && file_exists(CONTROLLER_PATH . "$url_path[0].php"))
      $this->controller = $url_path[0];
    else header("Location: ./notFound");

    require_once CONTROLLER_PATH . "$this->controller.php";

    $this->controller = new $this->controller;

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

  public static function urlProcess()
  {
    if (isset($_GET['url']))
      return explode("/", filter_var(trim($_GET['url'], '/')));
    return ['0' => 'home'];
  }
}
