<?php require_once("includes/header.php"); ?>
<?php
  $latest_blog = Blog::get_latest_blog();
  $all_projects = Project::count_items('projects');
  $random_number = rand(0, ($all_projects - 1));
  $random_project = Project::get_all_items('projects', $random_number, 1);
  $random_project = $random_project[0];
?>
    <div class="container__content">
    <h1 class="page__headline">jordanlewis.dev</h1>
    <?php if(isset($message->current_message) && stripos($message->current_message, 'error')): ?>
      <p class="error__message"><?php echo $message->current_message; ?></p>
    <?php elseif(isset($message->current_message)): ?>
      <p class="success__message"><?php echo $message->current_message; ?></p>
    <?php endif; ?>
      <section class="home__blog">
        <h3 class="home__blog--header">Latest Blog Post</h3>
<?php

  echo "
  <a href='/blog/blogs/{$latest_blog->id}' class='home__blog--link'><h4 class='home__blog--title'>{$latest_blog->title}</h4></a>
  <a href='/blog/blogs/{$latest_blog->id}' class='home__blog--link'><img src='/blog/admin/images/{$latest_blog->picture}' class='home__blog--image' alt='{$latest_blog->alt_text}'></a>
  <div class='home__blog--snippet'>{$latest_blog->show_snippet()}</div>
  ";
?>
      </section>
      <hr>
      <section class="home__blog">
          <h3 class="home__blog--header">Checkout this project!</h3>
      <?php
  echo "
  <a href='/blog/projects/{$random_project->id}' class='home__blog--link'><h4 class='home__blog--title'>{$random_project->title}</h4></a>
  <a href='/blog/projects/{$random_project->id}' class='home__blog--link'><img src='/blog/admin/images/{$random_project->picture}' class='home__blog--image' alt='{$random_project->alt_text}'></a>
  <div class='home__blog--snippet'>{$random_project->snippet}</div>
  ";
?>
      </section>
    </div>
<?php require_once("includes/footer.php"); ?>