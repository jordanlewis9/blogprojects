<?php require_once("../includes/init.php"); ?>
<?php
if (isset($_GET['blog_id'])) {
  Blog::delete_item('blogs', $_GET['blog_id']);
  redirect("blogs.php");
}

if (isset($_GET['project_id'])) {
  Project::delete_item('projects', $_GET['project_id']);
  redirect("projects.php");
}

if (isset($_GET['user_id'])) {
  User::delete_item('users', $_GET['user_id']);
  redirect("users.php");
}

?>