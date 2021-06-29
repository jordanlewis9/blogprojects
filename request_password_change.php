<?php require_once("includes/header.php"); ?>
<?php

if ($auth->signed_in && $auth->role !== "admin") {
  if ($token = User::create_password_change_token_id($auth->user_id)) {
    if(send_email($auth->email, $token)) {
      $message->set_message("An email has been sent to {$auth->email} for directions on changing your password.");
    } else {
      $message->set_message("There was an error sending an email to the stored address. Please try again.");
    }
  } else {
    $message->set_message("There was an error sending an email to the stored address. Please try again.");
  }
  redirect("index.php");
}

  if (isset($_POST['send_email'])) {
    $clean_input = new Clean_Input;
    if ($email = $clean_input->validate_email($_POST['email'])){
      if ($auth->does_email_exist($email)) {
        if ($token = User::create_password_change_token_email($email)) {
          if (send_email($email, $token)) {
            $message->set_message("An email has been sent to {$email} for directions on changing your password.");
          } else {
            $message->set_message("There was an error sending the email. Please try again.");
          }
        } else {
          $message->set_message("There was an error sending the email. Please try again.");
        }
      } else {
        $message->set_message("An email has been sent to {$email} for directions on changing your password.");
      }
    } 
    redirect("index.php");
  }
  ?>

<div class="container__content">
  <h2 class="auth__headline">Request Password Change</h2>
  <form action="request_password_change.php" method="POST">
    <div class="login__form--inputs">
      <label for="email" id="change__password--label">Enter email</label>
      <div class="input__container">
        <input type="email" class="input__email" id="email" name="email" required>
      </div>
    </div>
    <div class="login__form--inputs">
      <input type="submit" name="send_email" value="Send Email" class="gen-btn login__form--btn">
    </div>
  </form>
</div>

<?php require_once("includes/footer.php"); ?>
