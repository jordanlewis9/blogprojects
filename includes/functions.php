<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require './vendor/autoload.php';

function redirect($url) {
  header("Location: {$url}");
  exit;
}

function send_email($user_email, $tokenforlink) {
  $mail = new PHPMailer();

  //Tell PHPMailer to use SMTP
  $mail->isSMTP();

  //Enable SMTP debugging
  //SMTP::DEBUG_OFF = off (for production use)
  //SMTP::DEBUG_CLIENT = client messages
  //SMTP::DEBUG_SERVER = client and server messages
  $mail->SMTPDebug = SMTP::DEBUG_SERVER;

  //Set the hostname of the mail server
  $mail->Host = 'smtp.gmail.com';
  //Use `$mail->Host = gethostbyname('smtp.gmail.com');`
  //if your network does not support SMTP over IPv6,
  //though this may cause issues with TLS

  //Set the SMTP port number:
  // - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
  // - 587 for SMTP+STARTTLS
  $mail->Port = 465;

  //Set the encryption mechanism to use:
  // - SMTPS (implicit TLS on port 465) or
  // - STARTTLS (explicit TLS on port 587)
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

  //Whether to use SMTP authentication
  $mail->SMTPAuth = true;

  //Username to use for SMTP authentication - use full email address for gmail
  $mail->Username = INSERT EMAIL;

  //Password to use for SMTP authentication
  $mail->Password = INSERT PASSWORD;

  //Set who the message is to be sent from
  //Note that with gmail you can only use your account address (same as `Username`)
  //or predefined aliases that you have configured within your account.
  //Do not use user-submitted addresses in here
  $mail->setFrom(INSERT EMAIL, 'Jordan');

  //Set an alternative reply-to address
  //This is a good place to put user-submitted addresses
  // $mail->addReplyTo('replyto@example.com', 'First Last');

  //Set who the message is to be sent to
  $mail->addAddress($user_email, '');

  //Set the subject line
  $mail->Subject = 'PHPMailer GMail SMTP test';

  //Read an HTML message body from an external file, convert referenced images to embedded,
  //convert HTML into a basic plain-text alternative body
  // $mail->msgHTML(file_get_contents('contents.html'), __DIR__);
  $mail->Body = "A password change request was submitted for jordanlewis.dev. Visit this link to change your password. The link will expire in 15 minutes.";
  $mail->Body .= "<a href='localhost/blog/change_password?token={$tokenforlink}>Click here</a>";

  //Replace the plain text body with one created manually
  $mail->AltBody = "This is a plain-text message body with {$tokenforlink}";

  //Attach an image file

  //send the message, check for errors
  if (!$mail->send()) {
      return 'Mailer Error: ' . $mail->ErrorInfo;
      // return "not sent";
  } else {
      return 'Message sent!';
      // return "sent";
      //Section 2: IMAP
      //Uncomment these to save your message in the 'Sent Mail' folder.
      #if (save_mail($mail)) {
      #    echo "Message saved!";
      #}
  }
}



?>