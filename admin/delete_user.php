<?php require_once("../includes/init.php"); ?>
<?php
if (isset($_GET['user_id'])) {
  User::delete_item('users', $_GET['user_id']);
  redirect("users.php");
}

?>