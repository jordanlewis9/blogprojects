<?php require_once("includes/header.php"); ?>
<?php
  $all_projects = Project::get_all_items('projects');
?>
<div class="container">
  <div class="container__content">
    <h1 class="page__headline">Projects</h1>
<?php
  foreach($all_projects as $project) {
    echo "
    <section class='projects__section'>
      <a href='project.php?project_id={$project->id}' class='projects__section--link'><h2 class='projects__section--title'>{$project->title}</h2></a>
      <a href='project.php?project_id={$project->id}' class='projects__section--link'><img src='admin/images/{$project->picture}' class='projects__section--image'></a>
      <p class='projects__section--snippet'>{$project->snippet}</p>
    </section>
    <hr>
    ";
  }
?>
  </div>
</div>
<?php require_once("includes/footer.php"); ?>