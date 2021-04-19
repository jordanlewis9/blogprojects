<?php

class Database {

  public $connection;
  private $db_host = "localhost";
  private $db_user = "root";
  private $db_pass = "";
  private $db_name = "blog";

  function __construct() {
    $this->connect_db();
  }

  private function connect_db() {
    $this->connection = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
    if ($this->connection->connect_errno) {
      die("Database connection failed " . $this->connection->connect_error);
    }
  }

  public function delete($table, $id) {
    $stmt = $this->connection->prepare("DELETE FROM {$table} WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->affected_rows === 1) {
      return true;
    } else {
      return false;
    }
  }
}

$db = new Database();

?>