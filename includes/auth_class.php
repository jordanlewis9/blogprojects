<?php

class Auth {
  public $signed_in;
  public $username;
  private $login_key;
  public $role;
  public $user_id;
  public $email;

  private function get_current_user_and_auth() {
    global $db, $message;
    $id = trim($_SESSION['user_id']);
    $sql = "SELECT username, login_key, role, email, id FROM users WHERE id = ? LIMIT 1";
    $stmt = $db->connection->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows !== 1) {
      return $this->not_signed_in();
    }
    $stmt->bind_result($username, $login_key, $role, $email, $db_id);
    while ($stmt->fetch()) {
      if ($_SESSION['login_key'] === $login_key && $_SESSION['username'] === $username) {
        $this->signed_in = true;
        $this->login_key = $login_key;
        $this->username = $username;
        $this->email = $email;
        $this->role = $role;
        $this->user_id = $db_id;
      } else {
        $this->not_signed_in();
      }
    }
  }

  // have function that compares passwords. if default password is unchanged, do not hash password.
  // if default password is changed, hash password like normal

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
    $stmt->bind_result($username, $password, $role, $id);
    while ($stmt->fetch()) {
      if (password_verify($entered_password, $password)) {
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
  }

  public function logout_user() {
    global $db;
    $id = trim($this->user_id);
    $sql = "UPDATE users SET login_key = null WHERE id = ?";
    $stmt = $db->connection->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    if ($stmt->affected_rows === 1) {
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

  public function does_email_exist($email) {
    global $db;
    $sql = "SELECT email FROM users WHERE email = ?";
    $stmt = $db->connection->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 0) {
      return false;
    }
    return true;
  }

  private function encrypt_password($entered_password) {
    $entered_password = trim($entered_password);
    return password_hash($entered_password, PASSWORD_DEFAULT);
  }

}

$auth = new Auth();

?>