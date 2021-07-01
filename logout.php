<?php require_once("includes/init.php"); ?>
<?php 
if ($auth->logout_user()) {
  redirect("/blog");
} else {
  $message->set_message("There was an error logging out. Please try again.");
  redirect("/blog");
}
?>