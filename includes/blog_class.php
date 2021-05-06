<?php

class Blog extends Methods {
  public $id;
  public $title;
  public $content;
  public $picture;
  public $created;
  public $views;
  public $tmp_path;
  public $updated;
  public $class_properties = ["created", "updated", "views", "id", "title", "content", "picture"];

  public function new_blog() {
    global $db;
    if ($this->transfer_image()) {
      $sql = "INSERT INTO blogs (" . implode(", ", array_slice($this->class_properties, 4)) . ") VALUES (";
      $sql .= "'{$this->title}', '{$this->content}', '{$this->picture}')";
      $db->query($sql);
      redirect("blogs.php");
    } else {
      redirect("add_blog.php");
    }
  }

  public function update_blog() {
    global $db;
    if ($this->transfer_image()) {
      $main_query = [];
      foreach (array_slice($this->class_properties, 2) as $prop) {
        $main_query[] = "{$prop} = '{$this->$prop}'";
      }
      $result = $db->query("UPDATE blogs SET created = NOW(), updated = true, " . implode(", ", $main_query) . " WHERE id = " . $this->id);
    } else {
      redirect("blogs.php?message=Blog update unsuccessful");
    }
  }

}