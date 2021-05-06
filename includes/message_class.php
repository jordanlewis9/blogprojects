<?php


class Message {
  public $current_message;
  public $blog_content;

  function __construct() {
    if (isset($_SESSION['message'])) {
      $this->current_message = $_SESSION['message'];
      unset($_SESSION['message']);
    }
    if (isset($_SESSION['blog_content'])) {
      $this->blog_content = $_SESSION['blog_content'];
      unset($_SESSION['blog_content']);
    }
  }

  public function set_message($msg) {
    $_SESSION['message'] = $msg;
  }

  public function set_blog_content($content) {
    $_SESSION['blog_content'] = $content;
  }
}

$message = new Message();

?>