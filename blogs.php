<?php require_once("includes/header.php"); ?>
<?php 

  if (isset($_GET['page'])) {
    $paginate = new Paginate(Blog::count_items('blogs'), 10, $_GET['page']);
  } else {
    $paginate = new Paginate(Blog::count_items('blogs'), 10, 1);
  }
  $all_blogs = Blog::get_all_items('blogs', $paginate->return_offset(), $paginate->num_per_page);
?>
  <div class="container__content">
    <h1 class="page__headline">Blog Posts</h1>
<?php
  foreach ($all_blogs as $blog) {
    echo "
    <section class='content__section'>
      <div class='content__section--content'>
        <a href='blog.php?blog_id={$blog->id}' class='content__section--link content__section--link-title'><h2 class='content__section--title'>{$blog->title}</h2></a>
        <p class='content__section--snippet'>{$blog->show_snippet()}</p>
      </div>
      <a href='blog.php?blog_id={$blog->id}' class='content__section--link content__section--link-picture'><img src='admin/images/{$blog->picture}' class='content__section--image'></a>
    </section>
    <hr>
    ";
  }
?>
<?php $paginate->show_pagination(); ?>
  </div>
</div>
<?php require_once("includes/footer.php"); ?>