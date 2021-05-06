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
<h1><?php echo $project->title; ?></h1>
<a href="<?php echo $project->link; ?>"><img src="admin/images/<?php echo $project->picture; ?>"></a>
<p><?php echo $project->description; ?></p>
<p>Click <a href="<?php echo $project->link; ?>">here</a> to check it out!</p>

<?php require_once("includes/footer.php"); ?>