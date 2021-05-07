<?php require_once("includes/header.php"); ?>
<?php 
  $all_blogs = Blog::get_all_items('blogs');
?>
  <div class="container__content">
    <h1 class="page__headline">Blog Posts</h1>
<?php
  foreach ($all_blogs as $blog) {
    echo "
    <section class='content__section'>
      <div class='content__section--content'>
        <a href='blog.php?blog_id={$blog->id}' class='content__section--link content__section--link-title'><h2 class='content__section--title'>{$blog->title}</h2></a>
        <p class='content__section--snippet'>{$blog->content}</p>
      </div>
      <a href='blog.php?blog_id={$blog->id}' class='content__section--link content__section--link-picture'><img src='admin/images/{$blog->picture}' class='content__section--image'></a>
    </section>
    <hr>
    ";
  }
?>
  </div>
</div>
<?php require_once("includes/footer.php"); ?>