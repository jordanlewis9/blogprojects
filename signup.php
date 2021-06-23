<?php require_once("includes/header.php"); ?>
<?php

  if ($auth->signed_in && $auth->role !== 'admin'){
    redirect("index.php");
  }

  if (isset($_POST['submit'])) {
    $clean_input = new Clean_Input;
    $new_user = new User;
    $clean_input->isValid[] = $new_user->username = $clean_input->validate_username($_POST['username']);
    $clean_input->isValid[] = $new_user->email = $clean_input->validate_email($_POST['email']);
    $clean_input->isValid[] = $new_user->first_name = $clean_input->validate_name($_POST['first_name']);
    $clean_input->isValid[] = $new_user->last_name = $clean_input->validate_name($_POST['last_name']);
    $clean_input->isValid[] = $new_user->password = $clean_input->validate_password($_POST['password']);
    if (in_array(false, $clean_input->isValid, true)) {
      redirect("signup.php");
    } else {
      $new_user->public_add_user();
    }
  }

?>

<div class="container__content">
<h2 class="auth__headline">Sign up to take part in the discourse - it's free!</h2>
<?php if (isset($message->current_message)): ?>
  <p class="error__message"><?php echo $message->current_message; ?></p>
<?php endif; ?>
<form method="POST" action="" class="signup__form">
    <div class="signup__form--inputs">
      <label class="signup__form--labels" for="username">Username</label>
      <div class="input__container">
        <input class="signup__form--content input__username" type="text" name="username" id="username" required>
      </div>
    </div>
    <div class="signup__form--inputs">
      <label class="signup__form--labels" for="email">Email</label>
      <div class="input__container">
        <input class="signup__form--content input__email" type="email" name="email" id="email" required>
      </div>
    </div>
    <div class="signup__form--inputs">
      <label class="signup__form--labels" for="first_name">First Name</label>
      <div class="input__container">
        <input class="signup__form--content input__first-name" type="text" name="first_name" id="first_name" required>
      </div>
    </div>
    <div class="signup__form--inputs">
      <label class="signup__form--labels" for="last_name">Last Name</label>
      <div class="input__container">
        <input class="signup__form--content input__last-name" type="text" name="last_name" id="last_name" required>
      </div>
    </div>
    <div class="signup__form--inputs">
      <label class="signup__form--labels" for="password">Password</label>
      <div class="input__container">
        <input class="signup__form--content input__password" type="password" name="password" id="password" required>
      </div>
    </div>
    <div class="signup__form--inputs">
      <input class="gen-btn signup__form--button" type="submit" name="submit" value="Sign Up">
    </div>
</form>
</div>


<?php require_once("includes/footer.php"); ?>