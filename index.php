<?php require_once("includes/header.php"); ?>
<?php
  $latest_blog = Blog::get_latest_blog();
  $all_projects = Project::get_all_items('projects');
  $random_number = rand(0, (count($all_projects) - 1));
  $random_project = $all_projects[$random_number];
?>
  <div class="container">
<?php if(isset($message->current_message)): ?>
  <p><?php echo $message->current_message; ?></p>
<?php endif; ?>
    <div class="container__content">
      <section>
        <h2 class="home__header">Latest Blog Post</h2>
<?php
  echo "
  <a href='blog.php?blog_id={$latest_blog->id}'><h2>{$latest_blog->title}</h2></a>
  <a href='blog.php?blog_id={$latest_blog->id}'><img src='admin/images/{$latest_blog->picture}'></a>
  <a href='blog.php?blog_id={$latest_blog->id}'><p>{$latest_blog->content}</p></a>
  ";
?>
      </section>
      <section>
      <?php
  echo "
  <a href='project.php?project_id={$random_project->id}'><h2>{$random_project->title}</h2></a>
  <a href='project.php?project_id={$random_project->id}'><img src='admin/images/{$random_project->picture}'></a>
  <a href='project.php?project_id={$random_project->id}'><p>{$random_project->snippet}</p></a>
  ";
?>
      </section>
    </div>
  </div>
<?php
require_once("includes/footer.php");
?>