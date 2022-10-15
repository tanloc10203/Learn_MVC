<?php

namespace app\core\db;

use app\core\Model;
use PDO;

abstract class DbModel extends Model
{
  abstract public function tableName(): string;

  abstract public function attributes(): array;

  abstract public function primaryKey(): string;

  public function save()
  {
    $tableName = $this->tableName();
    $attributes = $this->attributes();
    $params = array_map(fn ($attr) => ":$attr", $attributes);
    $statement = $this->prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ") VALUES(" . implode(',', $params) . ");");

    foreach ($attributes as $attribute)
      $statement->bindValue(":$attribute", $this->{$attribute});

    $statement->execute();
    return true;
  }

  public function update($id)
  {
    $tableName = $this->tableName();
    $attributes = $this->attributes();
    $params = array_map(fn ($attr) => ":$attr", $attributes);
    $statement = $this->prepare("UPDATE  $tableName SET " . implode(',', $attributes) . "=" . implode(',', $params) . " WHERE id=:id;");

    foreach ($attributes as $attribute)
      $statement->bindValue(":$attribute", $this->{$attribute});

    $statement->bindValue(":id", $id, PDO::PARAM_INT);
    $statement->execute();

    return true;
  }

  public function getAll($params = [])
  {
    $tableName = $this->tableName();
    $statement = $this->prepare("SELECT * FROM $tableName");
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    return $statement->fetchAll();
  }

  public function findById($id)
  {
    $tableName = $this->tableName();
    $statement = $this->prepare("SELECT * FROM $tableName WHERE id=:id;");
    $statement->execute(['id' => $id]);
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    return $statement->fetch();
  }

  public function delete($id)
  {
    $tableName = $this->tableName();
    $statement = $this->prepare("DELETE FROM $tableName WHERE id=:id;");
    $statement->execute(['id' => $id]);
    return true;
  }

  public function prepare($sql)
  {
    return $this->getConn()->prepare($sql);
  }
}
