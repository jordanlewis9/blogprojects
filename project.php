<?php require_once("includes/header.php"); ?>
<?php
  if (isset($_GET['project_id'])) {
    $project = Project::get_item_by_id('projects', $_GET['project_id']);
    if (!$project) {
      $message->set_message("No project exists at the given id {$_GET['project_id']}.");
      redirect("projects.php");
    }
  } else {
    $message->set_message("Improper parameters given.");
    redirect("projects.php");
  }
?>
<div class="container__content">
  <h1 class="project__headline"><?php echo $project->title; ?></h1>
  <a href="<?php echo $project->link; ?>" target="_blank"><img src="admin/images/<?php echo $project->picture; ?>" class="project__image"></a>
  <p class="project__description"><?php echo $project->description; ?></p>
  <p class="project__link">Click <a href="<?php echo $project->link; ?>" target="_blank" class="cta-link">here</a> to check it out!</p>
</div>

<?php require_once("includes/footer.php"); ?>