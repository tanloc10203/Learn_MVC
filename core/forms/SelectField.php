<?php

namespace app\core\forms;

use app\core\Model;

class SelectField
{
  public Model $model;
  public string $attribute;

  public function __construct(Model $model, string $attribute)
  {
    $this->model = $model;
    $this->attribute = $attribute;
  }


  public function select_start()
  {
    return sprintf(
      '<select id="%s" name="%s" class="form-control %s">',
      $this->attribute,
      $this->attribute,
      $this->model->hasError($this->attribute) ? 'is-invalid' : '',
    );
  }

  public function renderOption($value = "", $label = "")
  {
    return sprintf(
      '<option value="%s" %s>%s</option>',
      $value,
      (int) $value === (int) $this->model->{$this->attribute} ? 'selected' : '',
      $label
    );
  }

  public function renderOptionFirst($label = "")
  {
    return "<option disabled value>$label</option>";
  }

  public function select_end()
  {
    return "</select>";
  }

  public function renderErrSelect()
  {
    return sprintf(
      '<div class="invalid-feedback">
        %s
      </div>',
      $this->model->getFirstError($this->attribute)
    );
  }
}
