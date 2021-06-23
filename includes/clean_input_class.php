<?php

class Clean_Input {
  public $isValid = [];

  public function validate_username($username) {
    global $message;
    if (preg_match("/^(\w|\d){4,15}$/", $username)) {
      $username = htmlspecialchars($username, ENT_QUOTES);
      return $username;
    } else {
      $message->set_message("Invalid username. Please enter a different username.");
      return false;
    }
  }

  public function validate_password($password) {
    global $message;
    $isValid = [];
    $isValid[] = preg_match("/[A-Z]/", $password);
    $isValid[] = preg_match("/[a-z]/", $password);
    $isValid[] = preg_match("/^\S{6,20}$/", $password);
    if (in_array(false, $isValid)) {
      $message->set_message("Invalid password. Passwords must be between 6-20 characters long, have 1 uppercase letter, 1 lowercase letter, and no spaces.");
      return false;
    } else {
      return $password;
    }
  }

  public function validate_email($email) {
    global $message;
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if ($email) {
      return $email;
    } else {
      $message->set_message("Invalid email. Please enter a different email.");
      return false;
    }
  }

  public function validate_name($name) {
    global $message;
    if (preg_match("/^[a-zA-Z']{1,30}([\-a-zA-Z']{1,20}|[\sa-zA-Z']{1,20})?([\s\-a-zA-Z']{1,20})?$/", $name)) {
      $name = htmlspecialchars($name, ENT_QUOTES);
      return $name;
    } else {
      $message->set_message("Invalid name. Please try again.");
      return false;
    }
  }

  public function validate_comment($comment) {
    global $message;
    if (preg_match("/^.{2,}$/", $comment)) {
      $comment = htmlspecialchars($comment, ENT_QUOTES);
      return $comment;
    } else {
      $message->set_message("Invalid comment. Please try again.");
      return false;
    }
  }
}