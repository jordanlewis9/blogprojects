<?php

class Auth {
  public $signed_in;
  public $username;
  private $login_key;
  public $role;
  public $user_id;

  private function get_current_user_and_auth() {
    global $db;
    $user = $db->query("SELECT username, login_key, role, id FROM users WHERE id = {$_SESSION['user_id']} LIMIT 1");
    $user = $user->fetch_array();
    if ($_SESSION['login_key'] === $user['login_key'] && $_SESSION['username'] === $user['username']) {
      $this->signed_in = true;
      $this->login_key = $user['login_key'];
      $this->username = $user['username'];
      $_SESSION['role'] = $this->role = $user['role'];
      $this->user_id = $user['id'];
    } else {
      $this->not_signed_in();
    }
  }

  function __construct() {
    if (isset($_SESSION['login_key']) && isset($_SESSION['username']) && isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
      $this->get_current_user_and_auth();
    } else {
      $this->not_signed_in();
    }
  }

  public function login_user($entered_username, $entered_password) {
    global $db;
    $entered_username = trim($entered_username);
    $entered_password = trim($entered_password);
    $sql = "SELECT username, password, role, id FROM users WHERE username = ?";
    $stmt = $db->connection->prepare($sql);
    $stmt->bind_param('s', $entered_username);
    $stmt->execute();
    // if ($stmt->affected_rows !== 1) {
    //   return false;
    // }
    $stmt->bind_result($username, $password, $role, $id);
    while ($stmt->fetch()) {
      if ($entered_password === $password) {
      $_SESSION['username'] = $username;
      $_SESSION['user_id'] = $id;
      $_SESSION['role'] = $role;
      $key = $this->generate_login_key();
      $_SESSION['login_key'] = $key;
      $stmt->close();
      $db->query("UPDATE users SET login_key = '{$key}' WHERE id = {$id}");
      return true;
      } else {
        return false;
      }
    }
    // $result = $db->query("SELECT username, password, role, id FROM users WHERE username = '{$entered_username}'");
    // $result = $result->fetch_array();
    // if ($entered_password === $result['password']) {
    //   $_SESSION['username'] = $result['username'];
    //   $_SESSION['user_id'] = $result['id'];
    //   $_SESSION['role'] = $result['role'];
    //   $key = $this->generate_login_key();
    //   $_SESSION['login_key'] = $key;
    //   $db->query("UPDATE users SET login_key = '{$key}' WHERE id = {$result['id']}");
    //   return true;
    // } else {
    //   return false;
    // }
  }

  public function logout_user() {
    global $db;
    $db->query("UPDATE users SET login_key = null WHERE id = {$this->user_id}");
    if ($db->connection->affected_rows === 1) {
      $this->not_signed_in();
      return true;
    } else {
      return false;
    }
  }

  private function generate_login_key() {
    $login_key = random_bytes(20);
    return bin2hex($login_key);
  }

  private function not_signed_in() {
    $this->signed_in = false;
    unset($_SESSION['login_key']);
    unset($_SESSION['username']);
    unset($_SESSION['user_id']);
    unset($_SESSION['role']);
  }

  public function check_username_and_email($username, $email) {
    global $db, $message;
    $sql = "SELECT username, email FROM users WHERE username = ? OR email = ?";
    $stmt = $db->connection->prepare($sql);
    $stmt->bind_param('ss', $username, $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
      $stmt->bind_result($dbusername, $dbemail);
      while($stmt->fetch()) {
        if ($dbusername === $username) {
          $message->set_message("Username {$dbusername} is already in use. Please choose a different username.");
          break;
        } elseif ($dbemail === $email) {
          $message->set_message("Email {$dbemail} is already in use. Please choose a different one.");
          break;
        }
      } 
      return false;
    }
    return true;
  }

}

$auth = new Auth();

?>