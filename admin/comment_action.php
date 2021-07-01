<?php require_once("../includes/init.php"); ?>
<?php
if (!$auth->signed_in && $auth->role !== "admin") {
  redirect("/blog");
}
?>
<?php

$last_page = basename($_SERVER['HTTP_REFERER']);
if (isset($_GET['comment_id']) && isset($_GET['status'])) {
  if ($_GET['status'] === 'approved' || $_GET['status'] === 'denied') {
    $comment = Comment::get_comment_by_id($_GET['comment_id']);
    $comment->status = $_GET['status'];
    if ($comment->update_item("comments", array_slice($comment->class_properties, 4, 1))) {
      redirect("{$last_page}");
    } else {
      $message->set_message("Comment status could not be altered. Please try again.");
      redirect("{$last_page}");
    }
  } else {
    $message->set_message("Improper parameters given.");
    redirect("{$last_page}");
  }
} else {
  $message->set_message("Improper parameters given.");
  redirect("{$last_page}");
}

?>