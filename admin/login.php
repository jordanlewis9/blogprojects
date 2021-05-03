<?php require_once("includes/admin_header.php"); ?>
<?php print_r(session_id()); ?>

<form action="" method="POST" class="admin__form">
  <div class="admin__form--inputs">
    <label for="username">Username</label>
    <input type="text" id="username" name="username">
  </div>
  <div class="admin__form--inputs">
    <label for="password">Password</label>
    <input type="password" id="password" name="password">
  </div>
  <div class="admin__form--inputs">
    <input type="submit" name="login" value="Login" class="gen-btn admin__form--login-btn">
  </div>
</form>

<?php require_once("includes/admin_footer.php"); ?>