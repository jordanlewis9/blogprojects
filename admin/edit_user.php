<?php require_once("includes/admin_header.php"); ?>
<?php
if (isset($_GET['user_id'])) {
  $user_to_edit = User::get_item_by_id("users", $_GET['user_id']);
}

if (isset($_POST['update'])) {
  $user_to_edit->username = $_POST['username'];
  $user_to_edit->first_name = $_POST['first_name'];
  $user_to_edit->last_name = $_POST['last_name'];
  $user_to_edit->password = $_POST['password'];
  $user_to_edit->role = $_POST['role'];
  $user_to_edit->simple_update_item('users');
}
?>

<form method="POST" action="">
  <label for="username">Username</label>
  <input type="text" name="username" id="username" value="<?php echo $user_to_edit->username; ?>">
  <label for="first_name">First Name</label>
  <input type="text" name="first_name" id="first_name" value="<?php echo $user_to_edit->first_name; ?>">
  <label for="last_name">Last Name</label>
  <input type="text" name="last_name" id="last_name" value="<?php echo $user_to_edit->last_name; ?>">
  <label for="password">Password</label>
  <input type="password" name="password" id="password" value="<?php echo $user_to_edit->password; ?>">
  <label for="role">Role</label>
  <select id="role" name="role">
    <option value="subscriber" <?php  echo ($user_to_edit->role === 'subscriber') ? "selected" : ""; ?>>Subscriber</option>
    <option value="admin" <?php echo ($user_to_edit->role === 'admin') ? "selected" : ""; ?>>Admin</option>
  </select>
  <input type="submit" name="update" value="Update User">
</form>

<?php require_once("includes/admin_footer.php"); ?>