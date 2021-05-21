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
  <h1 class="blog__headline"><?php echo $blog->title; ?></h1>
  <img src="admin/images/<?php echo $blog->picture; ?>" class="blog__image">
  <p class="blog__author">By <?php echo $blog->author; ?></p>
  <p class="blog__time">
<?php if ($blog->updated): ?>
  <span class="blog__updated">Updated on </span>
<?php endif; ?>
<?php echo $blog->created; ?>
  </p>
  <article class="blog__content"><?php echo $blog->content; ?></article>
  <div class="comment__container">
    <h3 class="comment__headline">Comments</h3>
<?php if (count($comments) >= 1) {
  foreach ($comments as $comment) {
    echo "
    <section class='comment'>
      <p class='comment__username'>{$comment->username}</p>
      <p class='comment__created'>{$comment->created}</p>
      <p class='comment__content'>{$comment->content}</p>
    </section>
    ";
  }
}
?>
</div>
<?php if ($auth->signed_in): ?>
  <form method="POST" action="" class="comment__form">
    <label for="comment" class="comment__form--label">Enter Comment</label>
    <textarea id="comment" name="comment" rows="6" placeholder="Enter comment here..." class="comment__form--content"></textarea>
    <input type="submit" name="submit" value="Post Comment" class="gen-btn comment__form--button">
  </form>
<?php else: ?>
  <p><a href="signup.php" class="cta-link">Sign up</a> or <a href="login.php" class="cta-link">login</a> to comment on this post.</p>
<?php endif; ?>
</div>



<?php require_once("includes/footer.php"); ?>