<?php require_once("../includes/init.php"); ?>
<?php
if (!$auth->signed_in || $auth->role !== "admin") {
  redirect("/blog");
}
?>
<?php
if (isset($_GET['blog_id'])) {
  if (Blog::delete_item('blogs', $_GET['blog_id'])) {
    $message->set_message("Blog deleted successfully.");
    redirect("blogs.php");
  } else {
    $message->set_message("Unexpected error deleting blog.");
    redirect("edit_blog.php?blog_id={$_GET['blog_id']}");
  }

}

if (isset($_GET['project_id'])) {
  if (Project::delete_item('projects', $_GET['project_id'])) {
    $message->set_message("Project deleted successfully.");
    redirect("projects.php");
  } else {
    $message->set_message("Unexpected error deleting project.");
    redirect("edit_project.php?project_id={$_GET['project_id']}");
  }
}

if (isset($_GET['user_id'])) {
  if ($_GET['user_id'] === "1") {
    $message->set_message("This user cannot be deleted.");
    redirect("/blog");
  }
  if (User::delete_item('users', $_GET['user_id'])) {
    $message->set_message("User deleted successfully.");
    redirect("users.php");
  } else {
    $message->set_message("Unexpected error deleting user.");
    redirect("edit_user.php?user_id={$_GET['user_id']}");
  }
}

if (isset($_GET['comment_id'])) {
  if (Comment::delete_item('comments', $_GET['comment_id'])) {
    $message->set_message("Comment deleted successfully.");
    redirect("comments.php");
  } else {
    $message->set_message("Unexpected error deleting comment.");
    redirect("edit_comment.php?comment_id={$_GET['comment_id']}");
  }
}
?>