<?php

class Methods {
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
}