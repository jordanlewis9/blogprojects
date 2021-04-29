<?php require_once("../includes/init.php"); ?>
<?php
if (isset($_GET['project_id'])) {
  Project::delete_item('projects', $_GET['project_id']);
  redirect("projects.php");
}
?>