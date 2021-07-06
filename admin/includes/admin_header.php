<?php require_once("../includes/init.php"); ?>
<?php
if (!$auth->signed_in || $auth->role !== "admin") {
  redirect("/blog");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../build/styles.css" rel="stylesheet">
  <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
  <title>admin - jordanlewis.dev</title>
  <link rel="shortcut icon" href="/blog/admin/images/favicon.ico" type="image/x-icon" />
  <link rel="icon" href="/blog/admin/images/favicon.ico" type="image/x-icon" />
</head>
<body>
  <nav class="admin__nav">
    <ul class="admin__nav--list">
      <a href="/blog" class="admin__nav--item-link"><li class="admin__nav--item">Blog Home</li></a>
      <a href="index.php" class="admin__nav--item-link"><li class="admin__nav--item">Admin Home</li></a>
      <a href="projects.php" class="admin__nav--item-link"><li class="admin__nav--item">Projects</li></a>
      <a href="blogs.php" class="admin__nav--item-link"><li class="admin__nav--item">Blogs</li></a>
      <a href="comments.php" class="admin__nav--item-link"><li class="admin__nav--item">Comments</li></a>
      <a href="users.php" class="admin__nav--item-link"><li class="admin__nav--item">Users</li></a>
      <a href="/blog/logout" class="admin__nav--item-link"><li class="admin__nav--item">Logout</li></a>
    </ul>
  </nav>
  <div class="admin__container">
<?php if (isset($message->current_message) && stripos($message->current_message, 'success')): ?>
  <p class="admin__message success__message"><?php echo $message->current_message; ?></p>
<?php elseif (isset($message->current_message)): ?>
  <p class="admin__message error__message"><?php echo $message->current_message; ?></p>
<?php endif; ?>