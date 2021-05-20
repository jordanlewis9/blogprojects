<?php require_once("includes/header.php"); ?>
<?php

  if($auth->signed_in && $auth->role !== 'admin'){
    redirect("index.php");
  }

?>

<div class="container__content">
<h2 class="auth__headline">Sign up to take part in the discourse - it's free!</h2>
<form method="POST" action="" class="signup__form">
    <div class="signup__form--inputs">
      <label class="signup__form--labels" for="username">Username</label>
      <input class="signup__form--content" type="text" name="username" id="username">
    </div>
    <div class="signup__form--inputs">
      <label class="signup__form--labels" for="email">Email</label>
      <input class="signup__form--content" type="email" name="email" id="email">
    </div>
    <div class="signup__form--inputs">
      <label class="signup__form--labels" for="first_name">First Name</label>
      <input class="signup__form--content" type="text" name="first_name" id="first_name">
    </div>
    <div class="signup__form--inputs">
      <label class="signup__form--labels" for="last_name">Last Name</label>
      <input class="signup__form--content" type="text" name="last_name" id="last_name">
    </div>
    <div class="signup__form--inputs">
      <label class="signup__form--labels" for="password">Password</label>
      <input class="signup__form--content" type="password" name="password" id="password">
    </div>
    <div class="signup__form--inputs">
      <input class="gen-btn signup__form--button" type="submit" name="submit" value="Sign Up">
    </div>
</form>
</div>


<?php require_once("includes/footer.php"); ?>