<?php

class User extends Methods {
  public $id;
  public $username;
  public $email;
  public $first_name;
  public $last_name;
  public $password;
  public $role;
  public $class_properties = ['id', 'username', 'email', 'first_name', 'last_name', 'password', 'role'];

  public function add_user() {
    global $db, $message;
    $sql = "INSERT INTO users (" . implode(", ", array_slice($this->class_properties, 1, 5)) . ") VALUES ";
    $sql .= "('{$this->username}', '{$this->email}', '{$this->first_name}', '{$this->last_name}', '{$this->password}')";
    if ($db->query($sql)) {
      $message->set_message("User {$this->username} added successfully.");
      redirect("users.php");
    } else {
      $message->set_message("User {$this->username} could not be added. Please try again.");
      redirect("add_user.php");
    }
  }

  public function public_add_user() {
    global $db, $message, $auth;
    $sql = "INSERT INTO users (" . implode(", ", array_slice($this->class_properties, 1, 5)) . ") VALUES ";
    $sql .= "('{$this->username}', '{$this->email}', '{$this->first_name}', '{$this->last_name}', '{$this->password}')";
    if ($db->query($sql)) {
      $message->set_message("Welcome to the site, {$this->username}!");
      $auth->login_user($this->username, $this->password);
      redirect("index.php");
    } else {
      $message->set_message("There has been an error. Please try again.");
      redirect("signup.php");
    }
  }

  public static function get_all_users() {
    global $db;
    $sql = "SELECT id, username, email, role FROM users ORDER BY id ASC";
    $result = $db->query($sql);
    $all_users = [];
    while ($row = $result->fetch_array()) {
      $single_user = new self;
      $single_user->id = $row['id'];
      $single_user->username = $row['username'];
      $single_user->email = $row['email'];
      $single_user->role = $row['role'];
      $all_users[] = $single_user;
    }
    return $all_users;
  }
}


?>