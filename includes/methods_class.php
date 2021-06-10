<?php

class Methods {
  public $custom_errors = [];
  public $upload_errors = [
    UPLOAD_ERR_OK => "There is no error",
    UPLOAD_ERR_INI_SIZE=> "The uploaded file exceeds the upload_max_filesize directive in php.ini",
    UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
    UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
    UPLOAD_ERR_NO_FILE => "No picture was uploaded.",
    UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
    UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
    UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."
  ];

  public static function get_item_by_id($table, $id) {
    global $db;
    $table = trim($table);
    $id = trim($id);
    $sql = "SELECT * FROM {$table} WHERE id = ?";
    $stmt = $db->connection->prepare($sql);
    $stmt->bind_param("i", $id);
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

  public static function get_all_items($table, $offset, $how_many) {
    global $db;
    $table = trim($table);
    $result = $db->query("SELECT * FROM {$table} ORDER BY id DESC LIMIT {$offset}, {$how_many}");
    if ($result->num_rows === 0) {
      return false;
    }
    $all_items = [];
    while ($row = $result->fetch_array()) {
      $single_item = new static;
      foreach ($single_item->class_properties as $prop => $type) {
        $single_item->$prop = $row[$prop];
      }
      $all_items[] = $single_item;
    }
    return $all_items;
  }

  public function update_item($table, $prop_array) {
    global $db;
    list($main_query, $sanitized_items, $types_string, $is_valid) = $this->set_items($prop_array);
    if (!$is_valid) return false;
    $sanitized_items[] = $this->id;
    $types_string .= "i";
    $sql = "UPDATE {$table} SET " . implode(", ", $main_query) . " WHERE id = ?";
    $stmt = $db->connection->prepare($sql);
    $stmt->bind_param($types_string, ...$sanitized_items);
    $stmt->execute();
    if ($stmt->affected_rows === 1) {
      return true;
    } else {
      return false;
    }
  }

  public static function delete_item($table, $id) {
    global $db;
    $table = trim($table);
    $id = trim($id);
    $sql = "DELETE FROM {$table} WHERE id = ?";
    $stmt = $db->connection->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    if ($stmt->affected_rows === 1) {
      return true;
    } else {
      return false;
    }
  }

  public function set_file($file) {
    if (empty($file) || !$file || !is_array($file)) {
      $this->custom_errors[] = "No picture uploaded. Please upload a picture.";
    } elseif ($file['error'] !== 0) {
      $this->custom_errors[] = $this->upload_errors[$file['error']];
    } else {
      $this->picture = basename($file['name']);
      $this->tmp_path = $file['tmp_name'];
    }
  }

  public function transfer_image() {
    global $message;
    if (count($this->custom_errors) > 0) {
      if (isset($this->content)) {
        $message->set_blog_content($this->content);
      }
      $message->set_message(implode(", ", $this->custom_errors));
      unset($this->tmp_path);
      return false;
    } elseif (file_exists("images/{$this->picture}")) {
      unset($this->tmp_path);
      return true;
    } else {
      move_uploaded_file($this->tmp_path, "images/{$this->picture}");
      return true;
    }
  }

  public function format_time() {
    $created_date = new DateTime($this->created);
    $now = new DateTime('now');
    $diff = $created_date->add(new DateInterval('P7D')) > $now;
    if ($diff) {
      $day = $created_date->format('l');
    } else {
      $day = $created_date->format('n/j/y');
    }
    $this->created = "{$day} at {$created_date->format('g:ia')}";
  }

  protected function validate_email($email) {
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

  protected function set_items($prop_array) {
    $main_query = [];
    $sanitized_items = [];
    $types_string = '';
    $is_valid = true;
    foreach ($prop_array as $prop => $type) {
      $this->$prop = trim($this->$prop);
      $this->$prop = strip_tags($this->$prop);
      $types_string .= $type;
      if ($prop === "email") {
        if (!$this->$prop = $this->validate_email($this->$prop)) {
          $is_valid = false;
          break;
        }
      }
      $main_query[] = "{$prop} = ?";
      $sanitized_items[] = $this->$prop;
    }
    return [$main_query, $sanitized_items, $types_string, $is_valid];
  }

  public static function count_items($table) {
    global $db;
    $result = $db->query("SELECT COUNT(id) FROM {$table}");
    $row = mysqli_fetch_array($result);
    return array_shift($row);
  }

  public function content_format_read() {
    $this->content = str_replace('&nbsp;', '<br /><br />', $this->content);
    return $this->content;
  }

  public function content_format_edit() {
    $this->content = str_replace('&nbsp;', '<p>&nbsp;</p>', $this->content);
    return $this->content;
  }
}