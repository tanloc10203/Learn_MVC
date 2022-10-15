<?php

namespace app\core\db;

class Database
{
  private \PDO $conn;
  private string $host = 'localhost';
  private string $username = 'root';
  private string $password = '';
  private string $dbName = 'mvc_cnw';

  public function __construct()
  {
    try {
      $this->conn = new \PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username, $this->password);
      $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    } catch (\PDOException $e) {
      echo "Connection database failed: " . $e->getMessage();
      exit;
    }
  }

  public function getConn(): \PDO
  {
    return $this->conn;
  }
}
