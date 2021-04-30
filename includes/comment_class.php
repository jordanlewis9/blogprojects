<?php

class Comment extends Methods {
  public $id;
  public $user_id;
  public $username;
  public $preview;
  public $content;
  public $status;
  public $class_properties = ["id", "username", "user_id", "content", "status"];

  public static function find_all_comments() {
    global $db;
    $result = $db->query("SELECT * FROM comments LEFT JOIN users ON comments.user_id = users.id ORDER BY id ASC");
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

}