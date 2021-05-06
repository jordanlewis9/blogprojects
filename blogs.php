<?php require_once("includes/header.php"); ?>
<?php 
  $all_blogs = Blog::get_all_items('blogs');
?>
<div class="container">
  <div class="container__content">
    <h1 class="page__headline">Blog Posts</h1>
<?php
  foreach ($all_blogs as $blog) {
    echo "
    <section class='blogs__section'>
      <a href='blog.php?blog_id={$blog->id}' class='blogs__section--link'><h2 class='blogs__section--title'>{$blog->title}</h2></a>
      <a href='blog.php?blog_id={$blog->id}' class='blogs__section--link'><img src='admin/images/{$blog->picture}' class='blogs__section--image'></a>
      <p class='blogs__section--snippet'>{$blog->content}</p>
    </section>
    <hr>
    ";
  }
?>
  </div>
</div>
<?php require_once("includes/footer.php"); ?>