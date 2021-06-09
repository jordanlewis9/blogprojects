<?php

class Blog extends Methods {
  public $id;
  public $title;
  public $content;
  public $author;
  public $picture;
  public $alt_text;
  public $created;
  public $views;
  public $tmp_path;
  public $updated;
  public $class_properties = ["created" => "s", "updated" => "s", "views" => "i", "id" => "i", "title" => "s", "content" => "s", "picture" => "s", "author" => "s", "alt_text" => "s"];

  public function new_blog() {
    global $db, $message;
    if ($this->transfer_image()) {
      list($main_query, $sanitized_items, $types_string) = $this->set_items(array_slice($this->class_properties, 4));
      $sql = "INSERT INTO blogs SET " . implode(", ", $main_query);
      $stmt = $db->connection->prepare($sql);
      $stmt->bind_param($types_string, ...$sanitized_items);
      $stmt->execute();
      if ($stmt->affected_rows === 1) {
        $this->id = $stmt->insert_id;
        $message->set_message("Blog {$this->title} was successfully created! <a href='../blog.php?blog_id={$this->id}'>View here.</a>");
        redirect("blogs.php");
      } else {
        $message->set_message($stmt->error);
        $message->set_blog_content($this->content);
        redirect("add_blog.php");
      }
    } else {
      redirect("add_blog.php");
    }
  }

  // need prepared statements for below, comments, and projects!

  public function update_blog() {
    global $db, $message;
    if ($this->transfer_image()) {
      list($main_query, $sanitized_items, $types_string) = $this->set_items(array_slice($this->class_properties, 3));
      $sanitized_items[] = $this->id;
      $types_string .= "i";
      $sql = "UPDATE blogs SET created = NOW(), updated = true, " . implode(", ", $main_query) . " WHERE id = ?";
      $stmt = $db->connection->prepare($sql);
      $stmt->bind_param($types_string, ...$sanitized_items);
      $stmt->execute();
      if ($stmt->affected_rows === 1) {
        $message->set_message("Blog {$this->title} was successfully updated! <a href='../blog.php?blog_id={$this->id}'>View here.</a>");
        redirect("blogs.php");
      } else {
        $message->set_message($stmt->error);
        redirect("edit_blog.php?blog_id={$this->id}");
      }
    } else {
      redirect("edit_blog.php?blog_id={$this->id}");
    }
  }

  public static function get_latest_blog() {
    global $db, $message;
    $result = $db->query("SELECT * FROM blogs ORDER BY id DESC LIMIT 1");
    if ($result->num_rows === 0) {
      return false;
    }
    $retreived_blog = new self;
    while ($row = $result->fetch_array()) {
      foreach ($retreived_blog->class_properties as $prop => $type) {
        $retreived_blog->$prop = $row[$prop];
      }
    }
    return $retreived_blog;
  }

  public function show_snippet() {
    if (strlen($this->content) > 150) {
      $first_space = strpos($this->content, " ", 150);
      return substr($this->content, 0, $first_space) . "...";
    } else {
      return $this->content;
    }
  }
}