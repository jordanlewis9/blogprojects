<?php

class Methods {
  public $custom_errors = [];
  public $upload_errors = [
    UPLOAD_ERR_OK => "There is no error",
    UPLOAD_ERR_INI_SIZE=> "The uploaded file exceeds the upload_max_filesize directive in php.ini",
    UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
    UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
    UPLOAD_ERR_NO_FILE => "No file was uploaded.",
    UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
    UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
    UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."
  ];

  public static function get_item_by_id($table, $id) {
    global $db;
    $result = $db->query("SELECT * FROM {$table} WHERE id = {$id}");
    $retreived_item = new static;
    while ($row = $result->fetch_array()) {
      foreach ($retreived_item->class_properties as $prop) {
        $retreived_item->$prop = $row[$prop];
      }
    }
    return $retreived_item;
  }

  public static function get_all_items($table) {
    global $db;
    $result = $db->query("SELECT * FROM {$table} ORDER BY id ASC");
    $all_items = [];
    while ($row = $result->fetch_array()) {
      $single_item = new static;
      foreach ($single_item->class_properties as $prop) {
        $single_item->$prop = $row[$prop];
      }
      $all_items[] = $single_item;
    }
    return $all_items;
  }

  public function simple_update_item($table) {
    global $db;
    $main_query = [];
    foreach ($this->class_properties as $prop) {
      $main_query[] = "{$prop} = '{$this->$prop}'";
    }
    echo "UPDATE {$table} SET " . implode(", ", $main_query) . " WHERE id = " . $this->id;
    $result = $db->query("UPDATE {$table} SET " . implode(", ", $main_query) . " WHERE id = " . $this->id);
  }

  public static function delete_item($table, $id) {
    global $db;
    $result = $db->query("DELETE FROM {$table} WHERE id = {$id}");
  }

  public function set_file($file) {
    if (empty($file) || !$file || !is_array($file)) {
      $this->custom_errors[] = "No picture uploaded. Please upload a picture.";
      return false;
    } elseif ($file['error'] !== 0) {
      $this->custom_errors[] = $this->upload_errors[$file['error']];
      return false;
    } else {
      $this->picture = basename($file['name']);
      $this->tmp_path = $file['tmp_name'];
      return true;
    }
  }

  public function transfer_image() {
    if (file_exists("images/{$this->picture}")) {
      unset($this->tmp_path);
      return true;
    } elseif (count($this->custom_errors) > 0) {
      unset($this->tmp_path);
      return false;
    } else {
      move_uploaded_file($this->tmp_path, "images/{$this->picture}");
      return true;
    }
  }
}