<?php

namespace app\models;

use app\core\db\Database;

class CartModel extends Database
{
  public function create($data = [])
  {
    try {
      $sql = 'CALL `bill_create`(:quantity, :product_id, :status_id, :user_id);';
      $stmt = $this->getConn()->prepare($sql);
      $stmt->execute([
        ':quantity' => $data['quantity'],
        ':product_id' => $data['product_id'],
        ':status_id' => $data['status_id'],
        ':user_id' => $data['user_id'],
      ]);
      $stmt = $this->getConn()->query("SELECT LAST_INSERT_ID()");
      $lastId = $stmt->fetchColumn();
      return $lastId;
    } catch (\PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }

  public function getById($id)
  {
    try {
      $sql = 'CALL `bill_get_by_id`(:id);';
      $stmt = $this->getConn()->prepare($sql);
      $stmt->execute([':id' => $id]);
      $stmt->setFetchMode(\PDO::FETCH_ASSOC);
      return $stmt->fetch();
    } catch (\PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }

  public function getByUserId($id)
  {
    try {
      $sql = "CALL `bill_get_by_user_id`(:id);";
      $stmt = $this->getConn()->prepare($sql);
      $stmt->execute([':id' => $id]);
      $stmt->setFetchMode(\PDO::FETCH_ASSOC);
      return $stmt->fetchAll();
    } catch (\PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }

  public function getAll()
  {
    try {
      $sql = 'CALL `bill_get_all_admin`();';
      $statement = $this->getConn()->prepare($sql);
      $statement->execute();
      $statement->setFetchMode(\PDO::FETCH_ASSOC);
      return $statement->fetchAll();
    } catch (\PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }

  public function updateStatus($status_id, $id)
  {
    try {
      $sql = 'CALL `bill_update_status`(?, ?)';
      $statement = $this->getConn()->prepare($sql);
      $statement->execute([$status_id, $id]);
      return true;
    } catch (\PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
}
