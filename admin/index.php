<?php require_once("../includes/database_class.php"); ?>
<?php require_once("includes/admin_header.php"); ?>
<?php require_once("../includes/methods_class.php"); ?>
<?php require_once("../includes/user_class.php"); 
  $user = User::get_item_by_id("users", 2);
  $all_users = User::get_all_items("users");
  echo $user->username;
  echo "<br>";
  foreach ($all_users as  $single_user) {
    echo $single_user->username;
    echo "<br>";
  }
  $user->first_name = "Sarah";
  $user->username = "sarah";
  $user->simple_update_item("users");
?>


<?php require_once("includes/admin_footer.php"); ?>