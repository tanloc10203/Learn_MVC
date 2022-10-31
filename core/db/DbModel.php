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
    try {
      $tableName = $this->tableName();
      $attributes = $this->attributes();

      $attributes = array_filter($attributes, function ($attribute) {
        return !empty($this->{$attribute});
      });

      $params = array_map(fn ($attr) => "$attr=:$attr", $attributes);

      $sql = "UPDATE $tableName SET " . implode(',', $params) . " WHERE id=:id;";

      $statement = $this->prepare($sql);

      foreach ($attributes as $attribute)
        $statement->bindValue(":$attribute", $this->{$attribute});

      $statement->bindValue(":id", $id, PDO::PARAM_INT);
      $statement->execute();

      return true;
    } catch (\PDOException $e) {
      echo $sql . '<br>' . $e->getMessage();
    }
  }

  public function getAll($params = [])
  {
    $tableName = $this->tableName();
    $statement = $this->prepare("SELECT * FROM $tableName");

    if (count($params) > 0) {
      $limit = 5;
      $page = 0;
      $name_like = '';
      $name_query = '';

      if (isset($params['limit']) && (int)$params['limit'] > 0)
        $limit = $params['limit'];

      if (isset($params['page']) && (int)$params['page'] > 0)
        $page = $params['page'] - 1;

      if (
        isset($params['name_like']) &&
        !empty($params['name_like']) &&
        isset($params['name_query']) &&
        !empty($params['name_query'])
      ) {
        $name_like = $params['name_like'];
        $name_query = $params['name_query'];
      }

      $offset = $page * $limit;

      if (empty($name_query))
        $statement = $this->prepare("SELECT * FROM $tableName LIMIT $limit OFFSET $offset");
      else
        $statement = $this->prepare("SELECT * FROM $tableName WHERE $name_query LIKE '%$name_like%' LIMIT $limit OFFSET $offset");

      $statement->execute();
      $statement->setFetchMode(PDO::FETCH_ASSOC);
      return $statement->fetchAll();
    }

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

  public function count()
  {
    $tableName = $this->tableName();
    $statement = $this->prepare("SELECT COUNT(*) FROM $tableName");
    $statement->execute();
    return $statement->fetchColumn();
  }

  public function prepare($sql)
  {
    return $this->getConn()->prepare($sql);
  }

  public function findOne($where)
  {
    $tableName = static::tableName();
    $attributes = array_keys($where);
    $sql = implode("AND ", array_map(fn ($attr) => "$attr = :$attr", $attributes));
    $statement = self::prepare("SELECT * FROM $tableName WHERE $sql;");

    foreach ($where as $key => $item) {
      $statement->bindValue(":$key", $item);
    }

    $statement->execute();

    return $statement->fetchObject(static::class);
  }

  public function findOneAssoc($sql)
  {
    $statement = self::prepare($sql);
    $statement->execute();
    return $statement->fetchObject(static::class);
  }
}
