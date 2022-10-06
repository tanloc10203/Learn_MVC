<?php

namespace app\models;

use app\core\Database;

class HomeModel extends Database
{

  public function get()
  {
    try {
      $stmt = $this->getConn()->prepare("SELECT * FROM sinhvien");
      $stmt->execute();
      $stmt->setFetchMode(\PDO::FETCH_ASSOC);
      return $stmt->fetchAll();
    } catch (\PDOException $e) {
      echo "Error: " . $e->getMessage();
      exit;
    }
  }
}
