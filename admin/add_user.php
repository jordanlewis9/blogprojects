<?php require_once("includes/admin_header.php"); ?>
<?php
if (isset($_POST['submit'])) {
  $new_user = new User;
  $new_user->username = $_POST['username'];
  $new_user->first_name = $_POST['first_name'];
  $new_user->last_name = $_POST['last_name'];
  $new_user->password = $_POST['password'];
  $new_user->add_user();
}
?>

<form method="POST" action="">
  <label for="username">Username</label>
  <input type="text" name="username" id="username">
  <label for="first_name">First Name</label>
  <input type="text" name="first_name" id="first_name">
  <label for="last_name">Last Name</label>
  <input type="text" name="last_name" id="last_name">
  <label for="password">Password</label>
  <input type="password" name="password" id="password">
  <input type="submit" name="submit" value="Add User">
</form>

<?php require_once("includes/admin_footer.php"); ?>