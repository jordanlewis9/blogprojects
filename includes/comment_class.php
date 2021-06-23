<?php

class Comment extends Methods {
  public $id;
  public $user_id;
  public $username;
  public $preview;
  public $content;
  public $status;
  public $blog_id;
  public $title;
  public $created;
  public $class_properties = ["username" => 's', "title" => 's', "id" => 'i', "content" => 's', "status" => 's', "created" => 's', "blog_id" => 'i', "user_id" => 'i'];

  // public static function create_results($result) {
  //   $all_items = [];
  //   while ($row = $result->fetch_array()) {
  //     $single_item = new static;
  //     foreach (array_slice($single_item->class_properties, 0, 6) as $prop => $type) {
  //       $single_item->$prop = $row[$prop];
  //     }
  //     $all_items[] = $single_item;
  //   }
  //   return $all_items;
  // }

  private static function create_results($stmt) {
    $all_items = [];
    $stmt->bind_result($id, $content, $status, $username, $title, $created);
    while ($stmt->fetch()) {
      $single_item = new static;
      $results = ['id' => $id, 'content' => $content, 'status' => $status, 'username' => $username, 'title' => $title, 'created' => $created];
      foreach (array_slice($single_item->class_properties, 0, 6) as $prop => $type) {
        $single_item->$prop = $results[$prop];
      }
      $all_items[] = $single_item;
    }
    return $all_items;
  }

  private static function create_single_result($stmt) {
    $single_item = new static;
    $stmt->bind_result($id, $content, $status, $username, $title, $blog_id, $created);
    while ($stmt->fetch()) {
      $results = ['id' => $id, 'content' => $content, 'status' => $status, 'username' => $username, 'title' => $title, 'blog_id' => $blog_id, 'created' => $created];
      foreach (array_slice($single_item->class_properties, 0, 7) as $prop => $type) {
        $single_item->$prop = $results[$prop];
      }
    }
    return $single_item;
  }

  public static function get_all_comments($offset, $num_per_page) {
    global $db;
    $sql = "SELECT c.id, c.content, c.status, u.username, b.title, c.created FROM comments c INNER JOIN users u ON c.user_id = u.id INNER JOIN blogs b ON c.blog_id = b.id ORDER BY c.id DESC LIMIT {$offset}, {$num_per_page}";
    $stmt = $db->connection->prepare($sql);
    $stmt->execute();
    $all_comments = static::create_results($stmt);
    return $all_comments;
  }

  public static function get_need_action_comments() {
    global $db;
    $sql = "SELECT c.id, c.content, c.status, u.username, b.title, c.created FROM comments c INNER JOIN users u ON c.user_id = u.id INNER JOIN blogs b ON c.blog_id = b.id WHERE c.status = 'pending' ORDER BY c.id ASC";
    $stmt = $db->connection->prepare($sql);
    $stmt->execute();
    $all_comments = static::create_results($stmt);
    return $all_comments;
  }

  public static function get_blog_comments($blog_id) {
    global $db;
    $blog_id = trim($blog_id);
    $sql = "SELECT c.id, c.content, c.status, u.username, b.title, c.created FROM comments c INNER JOIN users u ON c.user_id = u.id INNER JOIN blogs b ON c.blog_id = b.id WHERE b.id = ? AND c.status = 'approved' ORDER BY c.id DESC";
    $stmt = $db->connection->prepare($sql);
    $stmt->bind_param('i', $blog_id);
    $stmt->execute();
    $all_comments = static::create_results($stmt);
    return $all_comments;
  }

  public static function get_comment_by_id($id) {
    global $db;
    $id = trim($id);
    $sql = "SELECT c.id, c.content, c.status, u.username, b.title, c.blog_id, c.created FROM comments c INNER JOIN users u ON c.user_id = u.id INNER JOIN blogs b ON c.blog_id = b.id WHERE c.id = ?";
    $stmt = $db->connection->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $comment = static::create_single_result($stmt);
    return $comment;
  }

  public static function add_new_comment($content, $user_id, $blog_id) {
    global $db, $message;
    $filtered_content = [$content, $user_id, $blog_id];
    $sql = "INSERT INTO comments SET content = ?, user_id = ?, blog_id = ?";
    $stmt = $db->connection->prepare($sql);
    $stmt->bind_param('sii', $content, $user_id, $blog_id);
    $stmt->execute();
    if ($stmt->affected_rows === 1) {
      $message->set_message("Comment has been successfully sent for approval.");
      redirect("blog.php?blog_id={$blog_id}");
    } else {
      $message->set_message("Comment could not be saved. Please try again.");
      redirect("blog.php?blog_id={$blog_id}");
    }
  }

}