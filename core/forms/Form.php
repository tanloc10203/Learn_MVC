<?php

namespace app\core\forms;

use app\core\Model;

class Form
{
  public static function begin($action, $method, $id, $display = false)
  {
    echo sprintf('<form action="%s" method="%s" id="%s" style="display: %s;">', $action, $method, $id, $display ? 'inline' : 'unset');
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
