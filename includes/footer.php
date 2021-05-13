  <div class="footer">
    <a href="index.php"><h5>jordanlewis.dev</h5></a>
    <a href="blogs.php"><p>Blogs</p></a>
    <a href="projects.php"><p>My Projects</p></a>
<?php if($auth->signed_in): ?>
    <a href="signout.php"><p>Sign Out</p></a>
<?php else: ?>
    <a href="login.php"><p>Log In</p></a>
<?php endif; ?>
    <p>Copyright by Jordan Lewis &#169; 2021</p>
  </div>
</div>
</body>
</html>