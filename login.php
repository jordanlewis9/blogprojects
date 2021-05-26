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
<div class="container__content">
<h2 class="auth__headline">Login</h2>
<form action="" method="POST" class="login__form">
  <div class="login__form--inputs">
    <label for="username">Username</label>
    <div class="input__container">
      <input type="text" class="input__username" id="username" name="username" required>
    </div>
  </div>
  <div class="login__form--inputs">
    <label for="password">Password</label>
    <div class="input__container">
      <input type="password" class="input__password" id="password" name="password" required>
    </div>
  </div>
  <div class="login__form--inputs">
    <input type="submit" name="login" value="Login" class="gen-btn login__form--btn">
  </div>
</form>
</div>

<?php require_once("includes/footer.php"); ?>