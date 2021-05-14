  <div class="footer">
    <a href="index.php"><h5>jordanlewis.dev</h5></a>
    <a href="blogs.php" class="footer__link"><p>Blogs</p></a>
    <a href="projects.php" class="footer__link"><p>My Projects</p></a>
<?php if($auth->signed_in): ?>
    <a href="signout.php" class="footer__link"><p>Sign Out</p></a>
<?php else: ?>
    <a href="login.php" class="footer__link"><p>Log In</p></a>
<?php endif; ?>
    <p>Copyright by Jordan Lewis &#169; 2021</p>
  </div>
</div>
</body>
</html>