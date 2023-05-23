<?php
class Database
{
  private $conn;

  public function __construct()
  {
    $db_name = 'mysql:host=localhost:3306;dbname=TechFusion';
    $user_name = 'root';
    $user_password = '';

    $this->conn = new PDO($db_name, $user_name, $user_password);
  }

  public function getConnection()
  {
    return $this->conn;
  }
}
?>