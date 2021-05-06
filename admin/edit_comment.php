<?php require_once("includes/admin_header.php"); ?>
<?php
if (isset($_GET['comment_id'])) {
  $comment = Comment::get_comment_by_id($_GET['comment_id']);
}

if (isset($_POST['update'])) {
  $comment->content = $_POST['content'];
  $comment->status = $_POST['status'];
  $comment->blog_id = $_POST['blog_id'];
  if ($comment->update_item("comments", array_slice($comment->class_properties, 2, 4))) {
    $message->set_message("Comment updated successfully.");
    redirect("comments.php");
  } else {
    $message->set_message("Comment update could not be saved. Please try again.");
    redirect("edit_comment.php?comment_id={$this->id}");
  }
}
?>

<form method="POST" action="" class="admin__form">
  <div class="admin__form--inputs comment__info">
    <p>Comment created by user <?php echo $comment->username; ?></p>
    <p>Comment for blog <?php echo $comment->title; ?></p>
  </div>
  <div class="admin__form--inputs">
    <label for="blog_id">Blog Id</label>
    <input type="text" name="blog_id" id="blog_id" value="<?php echo $comment->blog_id; ?>">
  </div>
  <div class="admin__form--inputs">
    <label for="content">Content</label>
    <textarea name="content" id="content" rows="4" cols="40"><?php echo $comment->content; ?></textarea>
  </div>
  <div class="admin__form--inputs" id="admin__form--radio">
    <label for="approve">Approve</label>
    <input type="radio" name="status" id="approve" value="approved" <?php echo ($comment->status === "approved") ? "checked" : ""; ?>>
    <label for="deny">Deny</label>
    <input type="radio" name="status" id="deny" value="denied" <?php echo ($comment->status === "denied") ? "checked" : ""; ?>>
<?php 
if ($comment->status === "pending") {
  echo "
  <label for='pending'>Pending</label>
  <input type='radio' name='status' id='pending' value='pending' checked>
  ";
}
?>
  </div>
  <div class="admin__form--inputs">
    <a href="delete_item.php?comment_id=<?php echo $comment->id; ?>" class="gen-btn admin__form--delete">Delete</a>
    <input class="gen-btn" type="submit" name="update" value="Update">
  </div>
</form>

<?php require_once("includes/admin_footer.php"); ?>