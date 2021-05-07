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
  public $class_properties = ["username", "title", "id", "content", "status", "created", "blog_id", "user_id"];

  public static function create_results($result) {
    $all_items = [];
    while ($row = $result->fetch_array()) {
      $single_item = new static;
      foreach (array_slice($single_item->class_properties, 0, 6) as $prop) {
        $single_item->$prop = $row[$prop];
      }
      $all_items[] = $single_item;
    }
    return $all_items;
  }

  public static function get_all_comments() {
    global $db;
    $result = $db->query("SELECT c.id, c.content, c.status, u.username, b.title, c.created FROM comments c INNER JOIN users u ON c.user_id = u.id INNER JOIN blogs b ON c.blog_id = b.id ORDER BY c.id ASC");
    $all_comments = static::create_results($result);
    return $all_comments;
  }

  public static function get_need_action_comments() {
    global $db;
    $result = $db->query("SELECT c.id, c.content, c.status, u.username, b.title, c.created FROM comments c INNER JOIN users u ON c.user_id = u.id INNER JOIN blogs b ON c.blog_id = b.id WHERE c.status = 'pending' ORDER BY c.id ASC");
    $all_comments = static::create_results($result);
    return $all_comments;
  }

  public static function get_blog_comments($blog_id) {
    global $db;
    $result = $db->query("SELECT c.id, c.content, c.status, u.username, b.title, c.created FROM comments c INNER JOIN users u ON c.user_id = u.id INNER JOIN blogs b ON c.blog_id = b.id WHERE b.id = {$blog_id} AND c.status = 'approved' ORDER BY c.id ASC");
    $all_comments = static::create_results($result);
    return $all_comments;
  }

  public static function get_comment_by_id($id) {
    global $db;
    $result = $db->query("SELECT c.id, c.content, c.status, u.username, b.title, c.blog_id, c.created FROM comments c INNER JOIN users u ON c.user_id = u.id INNER JOIN blogs b ON c.blog_id = b.id WHERE c.id = {$id}");
    $comment = new static;
    while ($row = $result->fetch_array()) {
      foreach (array_slice($comment->class_properties, 0, 7) as $prop) {
        $comment->$prop = $row[$prop];
      }
    }
    return $comment;
  }

  public static function add_new_comment($content, $user_id, $blog_id) {
    global $db, $message;
    $db->query("INSERT INTO comments (content, user_id, blog_id) VALUES ('{$content}', {$user_id}, {$blog_id})");
    if ($db->connection->affected_rows === 1) {
      $message->set_message("Comment has been saved and sent for approval.");
      redirect("blog.php?blog_id={$blog_id}");
    } else {
      $message->set_message("Comment could not be saved. Please try again.");
      redirect("blog.php?blog_id={$blog_id}");
    }
  }

}