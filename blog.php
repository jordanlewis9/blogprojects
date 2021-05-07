<?php require_once("includes/header.php"); ?>
<?php
  if (isset($_GET['blog_id'])) {
    $blog = Blog::get_item_by_id('blogs', $_GET['blog_id']);
    $comments = Comment::get_blog_comments($_GET['blog_id']);
    if (!$blog) {
      $message->set_message("No blog exists at the given id {$_GET['blog_id']}.");
      redirect("blogs.php");
    }
  } else {
    $message->set_message("Improper parameters given.");
    redirect("blogs.php");
  }

  if (isset($_POST['submit']) && $auth->signed_in) {
    Comment::add_new_comment($_POST['comment'], $auth->user_id, $_GET['blog_id']);
  }
?>
<div class="container__content">
  <h1><?php echo $blog->title; ?></h1>
  <img src="admin/images/<?php echo $blog->picture; ?>">
  <p>
<?php if ($blog->updated): ?>
  <span>Updated on </span>
<?php endif; ?>
<?php echo $blog->created; ?>
  </p>
  <p><?php echo $blog->content; ?></p>
<?php if (count($comments) >= 1) {
  foreach ($comments as $comment) {
    echo "
    <p>{$comment->username}</p>
    <p>{$comment->content}</p>
    ";
  }
}
?>
<?php if ($auth->signed_in): ?>
  <form method="POST" action="">
    <label for="comment">Enter Comment</label>
    <textarea id="comment" name="comment" cols="40" rows="6" placeholder="Enter comment here..."></textarea>
    <input type="submit" name="submit" value="Post Comment" class="gen-btn">
  </form>
<?php else: ?>
  <p>Sign up or login to comment on this post.</p>
<?php endif; ?>
</div>



<?php require_once("includes/footer.php"); ?>