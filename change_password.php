<?php require_once("includes/header.php"); ?>

<?php
  if (isset($_GET['token'])) {
    $user = User::find_user_by_pw_token($_GET['token']);
  }

?>

<?php echo $user->username; ?>
<div class="container__content">
  <h2 class="auth__headline">Change Password</h2>
  <form action="change_password.php" method="POST" class="change-password__form">
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
      <input type="submit" name="submit" value="Confirm" class="gen-btn login__form--btn">
    </div>
  </form>
</div>

<?php require_once("includes/footer.php"); ?>