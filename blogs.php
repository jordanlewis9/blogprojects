<?php require_once("includes/header.php"); ?>
<?php 
  $all_blogs = Blog::get_all_items('blogs');
?>
<div class="container">
  <div class="container__content">
<?php
  foreach ($all_blogs as $blog) {
    echo "
    <a href='blog.php?blog_id={$blog->id}'><section>
    <h2>{$blog->title}</h2>
    <img src='admin/images/{$blog->picture}'>
    <p>{$blog->content}</p>
  </section></a>
    ";
  }
?>
  </div>
</div>
<?php
require_once("includes/footer.php");
?>