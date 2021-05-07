<?php require_once("includes/header.php"); ?>
<?php
  $all_projects = Project::get_all_items('projects');
?>
  <div class="container__content">
    <h1 class="page__headline">Projects</h1>
<?php
  foreach($all_projects as $project) {
    echo "
    <section class='content__section'>
      <div class='content__section--content'>
        <a href='project.php?project_id={$project->id}' class='content__section--link content__section--link-title'><h2 class='content__section--title'>{$project->title}</h2></a>
        <p class='content__section--snippet'>{$project->snippet}</p>
      </div>
      <a href='project.php?project_id={$project->id}' class='content__section--link content__section--link-picture'><img src='admin/images/{$project->picture}' class='content__section--image'></a>
    </section>
    <hr>
    ";
  }
?>
  </div>
</div>
<?php require_once("includes/footer.php"); ?>