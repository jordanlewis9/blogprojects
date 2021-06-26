<?php

class Database {

  public $connection;
  private $db_host = DB_HOST;
  private $db_user = DB_USER;
  private $db_pass = DB_PASSWORD;
  private $db_name = DB_NAME;

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
    global $message;
    if (!$result) {
      $message->set_message("Query failed " . $this->connection->error);
      redirect("index.php");
    }
  }
}

$db = new Database();

?>