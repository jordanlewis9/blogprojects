<?php require_once("includes/header.php"); ?>

<?php
  if (isset($_GET['token'])) {
    $user = User::find_user_by_pw_token($_GET['token']);
  }

  if (isset($_POST['confirm'])) {
    if ($user->compare_passwords($_POST['password'], $_POST['confirm_password'])) {
      if ($user->update_item("users", $user->class_properties)) {
        if ($user->reset_pw_token()) {
          $message->set_message("Your password has successfully been changed.");
          $auth->login_user($user->username, $_POST['password']);
          redirect("index.php");
        } else {
          redirect("index.php");
        }
      } else {
        $message->set_message("There was an error resetting your password. Please try again.");
        redirect("change_password.php?token={$_GET['token']}");
      }
    } else {
      redirect("change_password.php?token={$_GET['token']}");
    }
  }

?>

<div class="container__content">
<?php if (isset($message->current_message)): ?>
  <p class="error__message"><?php echo $message->current_message; ?></p>
<?php endif; ?>
  <h2 class="auth__headline">Change Password</h2>
  <form action="change_password.php?token=<?php echo $_GET['token']; ?>" method="POST" class="change-password__form">
    <div class="change-password--inputs">
      <label for="password">New Password</label>
      <div class="input__container">
        <input type="password" class="input__password" id="password" name="password" required>
      </div>
    </div>
    <div class="change-password--inputs">
      <label for="confirm_password">Confirm Password</label>
      <div class="input__container">
        <input type="password" class="input__password confirm__password" id="confirm_password" name="confirm_password" required>
      </div>
    </div>
    <div class="change-password--inputs">
      <input type="submit" name="confirm" value="Confirm" class="gen-btn change-password__form--btn">
    </div>
  </form>
</div>

<?php require_once("includes/footer.php"); ?>