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
    global $db, $message;
    if ($this->transfer_image()) {
      $sql = "INSERT INTO blogs (" . implode(", ", array_slice($this->class_properties, 4)) . ") VALUES (";
      $sql .= "'{$this->title}', '{$this->content}', '{$this->picture}')";
      $db->query($sql);
      $message->set_message("Blog {$this->title} was successfully created! <a href='../blog.php?blog_id={$this->id}'>View here.</a>");
      redirect("blogs.php");
    } else {
      redirect("add_blog.php");
    }
  }

  public function update_blog() {
    global $db, $message;
    if ($this->transfer_image()) {
      $main_query = [];
      foreach (array_slice($this->class_properties, 2) as $prop) {
        $main_query[] = "{$prop} = '{$this->$prop}'";
      }
      $db->query("UPDATE blogs SET created = NOW(), updated = true, " . implode(", ", $main_query) . " WHERE id = " . $this->id);
      if ($db->connection->affected_rows === 1) {
        $message->set_message("Blog {$this->title} was successfully updated! <a href='../blog.php?blog_id={$this->id}'>View here.</a>");
        redirect("blogs.php");
      } else {
        $message->set_message("Blog update was unsuccessful. Please try again.");
        redirect("edit_blog.php?blog_id={$this->id}");
      }
    } else {
      redirect("edit_blog.php?blog_id={$this->id}");
    }
  }

}