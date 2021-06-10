<?php require_once("includes/header.php"); ?>
<?php
  if (isset($_GET['blog_id'])) {
    $blog = Blog::get_item_by_id('blogs', $_GET['blog_id']);
    $comments = Comment::get_blog_comments($_GET['blog_id']);
    if (!$blog) {
      $message->set_message("No blog exists at the given id {$_GET['blog_id']}.");
      redirect("blogs.php");
    }
    $blog->format_time();
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
  <img src="admin/images/<?php echo $blog->picture; ?>" class="blog__image" alt="<?php echo $blog->alt_text; ?>">
  <p class="blog__author">By <?php echo $blog->author; ?></p>
  <p class="blog__time">
<?php if ($blog->updated): ?>
  <span class="blog__updated">Updated on </span>
<?php endif; ?>
<?php echo $blog->created; ?>
  </p>
  <article class="blog__content"><?php echo $blog->content_format_read(); ?></article>
  <div class="comment__container">
    <h3 class="comment__headline">Comments</h3>
  <?php echo nl2br("Hello, my name\n is Jordan"); ?>
<?php require_once("includes/comments.php"); ?>
</div>



<?php require_once("includes/footer.php"); ?>