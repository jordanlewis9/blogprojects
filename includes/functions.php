<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'C:/wamp64/www/blog/vendor/autoload.php';

function redirect($url) {
  header("Location: {$url}");
  exit;
}

function send_email($user_email, $tokenforlink) {
  $mail = new PHPMailer();

  $mail->isSMTP();

  $mail->SMTPDebug = SMTP::DEBUG_OFF;

  $mail->Host = 'smtp.gmail.com';

  $mail->Port = 465;

  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

  $mail->SMTPAuth = true;

  $mail->Username = EMAIL;

  $mail->Password = EMAIL_PASSWORD;

  $mail->setFrom(EMAIL, 'Jordan');

  $mail->addAddress($user_email, '');


  $mail->Subject = 'Password change requested';

  $mail->Body = "A password change request was submitted for jordanlewis.dev. Visit <a href='" . WEBSITE . "/change_password.php?token={$tokenforlink}'>this link</a> to change your password. The link will expire in 15 minutes.";
  $mail->Body .= " If your email host does not allow clicking on links, copy and past the following address: " . WEBSITE . "/change_password.php?token={$tokenforlink}";

  $mail->AltBody = "This is a link to change your password for jordanlewis.dev. Copy and paste the following into your browser. This link expires in 15 minutes. localhost/blog/change_password.php?token={$tokenforlink}";

  if (!$mail->send()) {
      return false;
  } else {
      return true;

  }
}

function send_new_user_email($user_email, $username) {
  $mail = new PHPMailer();

  $mail->isSMTP();

  $mail->SMTPDebug = SMTP::DEBUG_OFF;

  $mail->Host = 'smtp.gmail.com';

  $mail->Port = 465;

  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

  $mail->SMTPAuth = true;

  $mail->Username = EMAIL;

  $mail->Password = EMAIL_PASSWORD;

  $mail->setFrom(EMAIL, 'Jordan');

  $mail->addAddress($user_email, '');


  $mail->Subject = 'Welcome to jordanlewis.dev!';

  $mail->Body = "Hello, {$username}! Thanks for signing up for an account on <a href='" . WEBSITE . "'>jordanlewis.dev</a>. Feel free to check out ";
  $mail->Body .= "some of our awesome content, and comment on the blogs! ";

  $mail->AltBody = "Someone with access to this email account signed up for an account at jordanlewis.dev. Thank you, and enjoy reading our content!";

  if (!$mail->send()) {
      return false;
  } else {
      return true;

  }
}



?>