<?php

class User extends Methods {
  public $id;
  public $username;
  public $first_name;
  public $last_name;
  public $password;
  public $role;
  public $class_properties = ['id', 'username', 'first_name', 'last_name', 'password', 'role'];

  public function add_user() {
    global $db;
    $sql = "INSERT INTO users (" . implode(", ", array_slice($this->class_properties, 1, 4)) . ") VALUES ";
    $sql .= "('{$this->username}', '{$this->first_name}', '{$this->last_name}', '{$this->password}')";
    $db->query($sql);
  }
}


?>