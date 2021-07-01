<?php require_once("includes/admin_header.php"); ?>
<?php
if (isset($_GET['user_id'])) {
  $user = User::get_item_by_id("users", $_GET['user_id']);
}

if (isset($_POST['update'])) {
  $clean_input = new Clean_Input;
  $clean_input->isValid[] = $user->username = $clean_input->validate_username($_POST['username']);
  $clean_input->isValid[] = $user->email = $clean_input->validate_email($_POST['email']);
  $clean_input->isValid[] = $user->first_name = $clean_input->validate_name($_POST['first_name']);
  $clean_input->isValid[] = $user->last_name = $clean_input->validate_name($_POST['last_name']);
  if (in_array(false, $clean_input->isValid, true)) {
    redirect("edit_user.php?user_id={$user->id}");
  }
  $user->password = $user->password;
  $user->role = $_POST['role'];
  if ($user->update_item('users', $user->class_properties)) {
    $message->set_message("User {$user->username} updated successfully.");
    redirect("users.php");
  } else {
    $message->set_message("User {$user->username} could not be updated. Please try again.");
    redirect("edit_user.php?user_id={$user->id}");
  }
}
?>

<form method="POST" action="" class="admin__form">
  <div class="admin__form--inputs">
    <label for="username">Username</label>
    <input type="text" name="username" id="username" value="<?php echo $user->username; ?>">
  </div>
  <div class="admin__form--inputs">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" value="<?php echo $user->email; ?>">
  </div>
  <div class="admin__form--inputs">
    <label for="first_name">First Name</label>
    <input type="text" name="first_name" id="first_name" value="<?php echo $user->first_name; ?>">
  </div>
  <div class="admin__form--inputs">
    <label for="last_name">Last Name</label>
    <input type="text" name="last_name" id="last_name" value="<?php echo $user->last_name; ?>">
  </div>
  <div class="admin__form--inputs">
    <label for="role">Role</label>
    <select id="role" name="role">
      <option value="subscriber" <?php  echo ($user->role === 'subscriber') ? "selected" : ""; ?>>Subscriber</option>
      <option value="admin" <?php echo ($user->role === 'admin') ? "selected" : ""; ?>>Admin</option>
    </select>
  </div>
  <div class="admin__form--inputs">
    <a href="delete_item.php?user_id=<?php echo $user->id; ?>" class="gen-btn admin__form--delete">Delete</a>
    <input class="gen-btn" type="submit" name="update" value="Update User">
  </div>
</form>

<?php require_once("includes/admin_footer.php"); ?>