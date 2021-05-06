<?php require_once("includes/header.php"); ?>
<?php
  if (isset($_GET['blog_id'])) {
    $blog = Blog::get_item_by_id('blogs', $_GET['blog_id']);
    if (!$blog) {
      $message->set_message("No blog exists at the given id {$_GET['blog_id']}.");
      redirect("blogs.php");
    }
  } else {
    $message->set_message("Improper parameters given.");
    redirect("blogs.php");
  }
?>
<h1><?php echo $blog->title; ?></h1>
<img src="admin/images/<?php echo $blog->picture; ?>">
<p>
<?php if ($blog->updated): ?>
<span>Updated on </span>
<?php endif; ?>
  <?php echo $blog->created; ?>
</p>
<p><?php echo $blog->content; ?></p>



<?php require_once("includes/footer.php"); ?>