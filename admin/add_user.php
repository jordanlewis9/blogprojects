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

<form method="POST" action="" class="admin__form">
  <div class="admin__form--inputs">
    <label for="username">Username</label>
    <input type="text" name="username" id="username">
  </div>
  <div class="admin__form--inputs">
    <label for="first_name">First Name</label>
    <input type="text" name="first_name" id="first_name">
  </div>
  <div class="admin__form--inputs">
    <label for="last_name">Last Name</label>
    <input type="text" name="last_name" id="last_name">
  </div>
  <div class="admin__form--inputs">
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
  </div>
  <div class="admin__form--inputs">
    <input class="gen-btn" type="submit" name="submit" value="Add User">
  </div>
</form>

<?php require_once("includes/admin_footer.php"); ?>