<?php require_once("includes/admin_header.php"); ?>
<?php
if (isset($_GET['comment_id'])) {
  $comment = Comment::get_comment_by_id($_GET['comment_id']);
}
?>

<form method="POST" action="" class="admin__form">
  <div class="admin__form--inputs">
    <p>Comment created by user <?php echo $comment->username; ?></p>
    <p>Comment for blog <?php echo $comment->title; ?></p>
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
    <label for="pending">Pending</label>
    <input type="radio" name="status" id="pending" value="pending" <?php echo ($comment->status === "pending") ? "checked" : ""; ?>>
  </div>
  <div class="admin__form--inputs">
    <input class="gen-btn" type="submit" name="update" value="Update Comment">
  </div>
</form>

<?php require_once("includes/admin_footer.php"); ?>