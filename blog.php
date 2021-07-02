<?php require_once("includes/header.php"); ?>
<?php
  if (isset($_GET['blog_id'])) {
    $blog = Blog::get_item_by_id('blogs', $_GET['blog_id']);
    if (!$blog) {
      $message->set_message("No blog exists at the given id {$_GET['blog_id']}.");
      redirect("/blog/blogs");
    }
    $comments = Comment::get_blog_comments($_GET['blog_id']);
    $blog->format_time();
    $blog->update_blog_views();
  } else {
    $message->set_message("Improper parameters given.");
    redirect("/blog/blogs");
  }

  if (isset($_POST['submit']) && $auth->signed_in) {
    $clean_input = new Clean_Input;
    if ($comment = $clean_input->validate_comment($_POST['comment'])) {
      Comment::add_new_comment($comment, $auth->user_id, $_GET['blog_id']);
    } else {
      redirect("/blog/blogs/{$GET['blog_id']}");
    }
  }
?>
<div class="container__content">
  <?php
  if (isset($message->current_message) && stripos($message->current_message, 'success')) {
    echo "<p class='success__message'>{$message->current_message}</p>";
  } else if (isset($message->current_message)) {
    echo "<p class='error__message'>{$message->current_message}</p>";
  }
  ?>
  <h1 class="blog__headline"><?php echo $blog->title; ?></h1>
  <img src="/blog/admin/images/<?php echo $blog->picture; ?>" class="blog__image" alt="<?php echo $blog->alt_text; ?>">
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
<?php require_once("includes/comments.php"); ?>
</div>



<?php require_once("includes/footer.php"); ?>