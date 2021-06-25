<?php require_once("includes/header.php"); ?>
<?php

  if (isset($_POST['send_email'])) {
    // check if email exists
    if ($auth->email && $auth->email === $_POST['email']) {
      // send email
      $token = User::create_password_change_token_id($auth->user_id);
      $msg = send_email('jlewis2008@live.com', '1234');
      $message->set_message($msg);
      // if(send_email('jlewis2008@live.com', $token)) {
          // $message->set_message("An email has been sent to {$_POST['send_email']} for directions on changing your password.");
      // } else {
        // $message->set_message("There was an error sending the email. Please try again.");
      // }
          // set message

              //redirect
              // redirect("index.php");
    } else {
      $clean_input = new Clean_Input;
      if ($email = $clean_input->validate_email($_POST['email'])){
        if ($auth->does_email_exist($email)) {
          $token = User::create_password_change_token_email($email);
          $msg = send_email('jlewis2008@live.com', '1234');
          $message->set_message($msg);
          // if (send_email('jlewis2008@live.com', $token)) {
          //   $message->set_message("An email has been sent to {$email} for directions on changing your password.");
          // } else {
            // $message->set_message("There was an error sending the email. Please try again.");
          // }
        } else {
          // $message->set_message("An email has been sent to {$email} for directions on changing your password.");
        }
            // send email

                // set message
                // $message->set_message("An email has been sent to {$email} for directions on changing your password.");
                    //redirect
                    // redirect("index.php");
      } 
    }
    // redirect("index.php");
    // redirect("request_password_change.php");
  }
  ?>

<?php

if (isset($message->current_message)) {
  echo $message->current_message;
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
