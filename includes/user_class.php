<?php

class User extends Methods {
  public $id;
  public $username;
  public $email;
  public $first_name;
  public $last_name;
  public $password;
  public $role;
  public $class_properties = ['id' => 'i', 'username' => 's', 'email' => 's', 'first_name' => 's', 'last_name' => 's', 'password' => 's', 'role' => 's'];

  public function add_user() {
    global $db, $message, $auth;
    if(!$this->email = $this->validate_email(trim($this->email))) {
      redirect("add_user.php");
    }
    $this->username = trim($this->username);
    $this->password = $this->encrypt_password($this->password);
    if (!$auth->check_username_and_email($this->username, $this->email)) {
      redirect("add_user.php");
    }
    list($main_query, $sanitized_items, $types_string, $is_valid) = $this->set_items(array_slice($this->class_properties, 1, 5));
    if (!$is_valid) {
      $message->set_message("Password is invalid. Please try again.");
      redirect("add_user.php");
    }
    $sql = "INSERT INTO users SET " . implode(", ", $main_query);
    $stmt = $db->connection->prepare($sql);
    $stmt->bind_param($types_string, ...$sanitized_items);
    $stmt->execute();
    if ($stmt->affected_rows === 1) {
      $message->set_message("User {$this->username} added successfully.");
      redirect("users.php");
    } else {
      $message->set_message("User {$this->username} could not be added. Please try again.");
      redirect("add_user.php");
    }
  }

  public function public_add_user() {
    global $db, $message, $auth;
    if (!$this->email = $this->validate_email(trim($this->email))) {
      redirect("signup.php");
    }
    $this->username = trim($this->username);
    $this->password = $this->encrypt_password($this->password);
    if (!$auth->check_username_and_email($this->username, $this->email)) {
      redirect("signup.php");
    }
    list($main_query, $sanitized_items, $types_string, $is_valid) = $this->set_items(array_slice($this->class_properties, 1, 5));
    if (!$is_valid) {
      $message->set_message("Password is invalid. Please try again.");
      redirect("signup.php");
    }
    $sql = "INSERT INTO users SET " . implode(", ", $main_query);
    $stmt = $db->connection->prepare($sql);
    $stmt->bind_param($types_string, ...$sanitized_items);
    $stmt->execute();
    if ($stmt->affected_rows === 1) {
      $message->set_message("Welcome to the site, {$this->username}!");
      $auth->login_user($this->username, $this->password);
      redirect("index.php");
    } else {
      $message->set_message("There has been an error. Please try again.");
      redirect("signup.php");
    }
  }

  protected function encrypt_password($entered_password) {
    $entered_password = trim($entered_password);
    return password_hash($entered_password, PASSWORD_DEFAULT);
  }

  protected function password_changed($entered_password) {
    global $db;
    $sql = "SELECT password FROM users WHERE id = {$this->id}";
    $result = $db->query($sql);
    $result = $result->fetch_assoc();
    $password = $result['password'];
    if ($entered_password === $password) {
      return false;
    } else {
      return true;
    }
  }

  public static function get_all_users($offset, $num_per_page) {
    global $db;
    $sql = "SELECT id, username, email, role FROM users ORDER BY id DESC LIMIT {$offset}, {$num_per_page}";
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

  public static function create_password_change_token_id($user_id) {
    global $db;
    $pw_token = random_bytes(20);
    $pw_token = bin2hex($pw_token);
    $sql = "UPDATE users SET new_pw_token = '{$pw_token}', new_pw_token_time = now() WHERE id = {$user_id}";
    $result = $db->query($sql);
    if ($db->connection->affected_rows === 1) {
      return $pw_token;
    } else {
      return false;
    }
  }

  public static function create_password_change_token_email($user_email) {
    global $db;
    $pw_token = random_bytes(20);
    $pw_token = bin2hex($pw_token);
    $sql = "UPDATE users SET new_pw_token = '{$pw_token}', new_pw_token_time = now() WHERE email = '{$user_email}'";
    $result = $db->query($sql);
    if ($db->connection->affected_rows === 1) {
      return $pw_token;
    } else {
      return false;
    }
  }

  public static function find_user_by_pw_token($token) {
    global $db;
    $sql = "SELECT * FROM users WHERE new_pw_token = ?";
    $stmt = $db->connection->prepare($sql);
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
      return false;
    }
    $retreived_item = new static;
    while ($row = $result->fetch_array()) {
      foreach ($retreived_item->class_properties as $prop => $type) {
        $retreived_item->$prop = $row[$prop];
      }
    }
    return $retreived_item;
  }

  public function compare_passwords($new_password, $confirm_password) {
    global $clean_input, $message;
    if ($new_password === $confirm_password) {
      if ($new_password = $clean_input->validate_password($new_password)) {
        $this->password = $new_password;
        return true;
      } else {
        return false;
      }
    } else {
      $message->set_message("New password and Confirm password do not match.");
      return false;
    }
  }

  public function reset_pw_token() {
    global $db;
    $sql = "UPDATE users SET new_pw_token = null, new_pw_token_time = null WHERE id = {$this->id}";
    $result = $db->query($sql);
    if ($db->connection->affected_rows === 1) {
      return true;
    } else {
      return false;
    }
  }
}


?>