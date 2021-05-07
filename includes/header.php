<?php require_once("includes/init.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="build/styles.css" rel="stylesheet">
</head>
<body>
  <nav class="nav">
    <ul class="nav__list">
      <a href="index.php" class="nav__list--link"><li class="nav__list--item">Home</li></a>
      <a href="blogs.php" class="nav__list--link"><li class="nav__list--item">Blog Posts</li></a>
      <a href="projects.php" class="nav__list--link"><li class="nav__list--item">Projects</li></a>
<?php if (isset($auth->role) && $auth->role === "admin"): ?>
      <a href="admin" class="nav__list--link"><li class="nav__list--item">Admin</li></a>
<?php endif; ?>
<?php if($auth->signed_in): ?>
      <a href="logout.php" class="nav__list--link gen-btn"><li class="nav__list--item">Logout</li></a>
<?php else: ?>
      <a href="login.php" class="nav__list--link gen-btn"><li class="nav__list--item">Login</li></a>
<?php endif; ?>
    </ul>
  </nav>
  <div class="container">