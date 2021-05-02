<?php require_once("../includes/init.php"); ?>
<?php

if (isset($_GET['comment_id']) && isset($_GET['status'])) {
  if ($_GET['status'] === 'approved' || $_GET['status'] === 'denied') {
    $comment = Comment::get_comment_by_id($_GET['comment_id']);
    $comment->status = $_GET['status'];
    $comment->update_item("comments", array_slice($comment->class_properties, 4, 1));
    redirect("comments.php");
  } else {
    redirect("comments.php?message=error");
  }
} else {
  redirect("comments.php?message=error");
}

?>