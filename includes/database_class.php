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

  public function query($sql) {
    $result = $this->connection->query($sql);
    $this->confirm_query($result);
    return $result;
  }

  private function confirm_query($result) {
    if (!$result) {
      die("Query failed " . $this->connection->error);
    }
  }
}

$db = new Database();

?>