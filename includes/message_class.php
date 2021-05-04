<?php


class Message {
  public $current_message;

  function __construct() {
    if (isset($_SESSION['message'])) {
      $this->current_message = $_SESSION['message'];
      unset($_SESSION['message']);
    }
  }

  public function set_message($msg) {
    $_SESSION['message'] = $msg;
  }
}

$message = new Message();

?>