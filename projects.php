<?php require_once("includes/header.php"); ?>
<?php
  $all_projects = Project::get_all_items('projects');
?>
<div class="container">
  <div class="container__content">
<?php
  foreach($all_projects as $project) {
    echo "
    <section>
    <a href='project.php?project_id={$project->id}'><h2>{$project->title}</h2></a>
    <a href='project.php?project_id={$project->id}'><img src='admin/images/{$project->picture}'></a>
    <a href='project.php?project_id={$project->id}'><p>{$project->snippet}</p></a>
    </section>
    ";
  }
?>
  </div>
</div>
<?php require_once("includes/footer.php"); ?>