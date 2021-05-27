<?php require_once("includes/header.php"); ?>
<?php
if (isset($auth->user_id)) {
  $user = User::get_item_by_id("users", $auth->user_id);
}

if (isset($_POST['update'])) {
  $user->username = $_POST['username'];
  $user->email = $_POST['email'];
  $user->first_name = $_POST['first_name'];
  $user->last_name = $_POST['last_name'];
  $user->password = $_POST['password'];
  if ($user->update_item('users', $user->class_properties)) {
    $message->set_message("Profile changes saved.");
    redirect("edit_profile.php");
  } else {
    if (isset($_SESSION['message'])) {
      redirect("edit_profile.php");
    }
    $message->set_message("There was an error saving your changes. Please try again.");
    redirect("edit_profile.php");
  }
}
?>

<div class="container__content">
<?php if (isset($message->current_message)): ?>
  <p class="error__message"><?php echo $message->current_message; ?></p>
<?php endif; ?>
<h2 class="auth__headline">Edit Profile</h2>
<form method="POST" action="" class="signup__form">
  <div class="signup__form--inputs">
    <label for="username" class="signup__form--labels">Username</label>
    <div class="input__container">
      <input type="text" name="username" id="username" class="signup__form--content input__username" value="<?php echo $user->username; ?>" required>
    </div>
  </div>
  <div class="signup__form--inputs">
    <label for="email" class="signup__form--labels">Email</label>
    <div class="input__container">
      <input type="email" name="email" id="email" class="signup__form--content input__email" value="<?php echo $user->email; ?>" required>
    </div>
  </div>
  <div class="signup__form--inputs">
    <label for="first_name" class="signup__form--labels">First Name</label>
    <div class="input__container">
      <input type="text" name="first_name" id="first_name" class="signup__form--content input__first-name" value="<?php echo $user->first_name; ?>" required>
    </div>
  </div>
  <div class="signup__form--inputs">
    <label for="last_name" class="signup__form--labels">Last Name</label>
    <div class="input__container">
      <input type="text" name="last_name" id="last_name" class="signup__form--content input__last-name" value="<?php echo $user->last_name; ?>" required>
    </div>
  </div>
  <div class="signup__form--inputs">
    <label for="password" class="signup__form--labels">Password</label>
    <div class="input__container">
      <input type="password" name="password" id="password" class="signup__form--content input__password" value="<?php echo $user->password; ?>" required>
    </div>
  </div>
  <div class="signup__form--inputs">
    <input class="gen-btn signup__form--button" type="submit" name="update" value="Save Changes">
  </div>
</form>
</div>


<?php require_once("includes/footer.php"); ?>