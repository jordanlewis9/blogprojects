<?php require_once("../includes/init.php"); ?>
<?php
if (!$auth->signed_in || $auth->role !== "admin") {
  redirect("../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../build/styles.css" rel="stylesheet">
  <title>Document</title>
</head>
<body>
  <nav class="admin__nav">
    <ul class="admin__nav--list">
      <a href="../index.php" class="admin__nav--item-link"><li class="admin__nav--item">Blog Home</li></a>
      <a href="index.php" class="admin__nav--item-link"><li class="admin__nav--item">Admin Home</li></a>
      <a href="projects.php" class="admin__nav--item-link"><li class="admin__nav--item">Projects</li></a>
      <a href="blogs.php" class="admin__nav--item-link"><li class="admin__nav--item">Blogs</li></a>
      <a href="comments.php" class="admin__nav--item-link"><li class="admin__nav--item">Comments</li></a>
      <a href="users.php" class="admin__nav--item-link"><li class="admin__nav--item">Users</li></a>
    </ul>
  </nav>
  <div class="admin__container">
<?php if (isset($message->current_message)): ?>
<p><?php echo $message->current_message; ?></p>
<?php endif; ?>