  <div class="footer">
    <a href="index.php" class="footer__link footer__link--home"><h5 class="footer__link--headline">jordanlewis.dev</h5></a>
    <a href="blogs.php" class="footer__link"><p>Blogs</p></a>
    <a href="projects.php" class="footer__link"><p>Projects</p></a>
<?php if($auth->signed_in): ?>
    <a href="edit_profile.php" class="footer__link"><p>Edit Profile</p></a>
    <a href="signout.php" class="footer__link"><p>Log Out</p></a>
<?php else: ?>
    <a href="login.php" class="footer__link"><p>Log In</p></a>
    <a href="signup.php" class="footer__link"><p>Sign Up</p></a>
<?php endif; ?>
    <p class="footer__copyright">Copyright by Jordan Lewis &#169; 2021</p>
  </div>
</div>
</body>
<script src="includes/scripts.js"></script>
</html>