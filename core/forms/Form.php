<?php

namespace app\core\forms;

use app\core\Model;

class Form
{
  public static function begin($action, $method, $id, $class = '')
  {
    echo sprintf('<form action="%s" method="%s" id="%s" class="%s">', $action, $method, $id, $class);
    return new Form();
  }

  public static function end()
  {
    echo '</form>';
  }

  public function field(Model $model, $attribute)
  {
    return new InputField($model, $attribute);
  }
}
