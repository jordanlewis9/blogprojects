<?php

class Auth {
  public $signed_in;
  public $username;
  private $key;
  public $role;
  public $user_id;

  private function get_current_user_and_auth() {
    global $db;
    $user = $db->query("SELECT username, key, role FROM users WHERE id = {$this->user_id} LIMIT 1");
    $user = $user->fetch_array();
    if ($this->key === $user->key && $this->username === $user->username) {
      $this->signed_in = true;
    } else {
      $this->signed_in = false;
    }
  }

  function __construct() {
    if (isset($_SESSION['key']) && isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
      $this->key = $_SESSION['key'];
      $this->username = $_SESSION['username'];
      $this->user_id = $_SESSION['user_id'];
      $this->get_current_user_and_auth();
    } else {
      $this->signed_in = false;
    }
  }

}

?>