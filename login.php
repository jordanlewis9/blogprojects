<?php require_once("includes/header.php"); ?>
<?php 
  if (isset($_POST['login'])) {
    if($auth->login_user($_POST['username'], $_POST['password'])) {
      redirect("index.php");
    } else {
      $message->set_message("Username or password incorrect");
      redirect("login.php");
    }
  }
?> 

<?php if (isset($message->current_message)): ?>
<p><?php echo $message->current_message; ?></p>
<?php endif; ?>
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

<?php require_once("includes/footer.php"); ?>