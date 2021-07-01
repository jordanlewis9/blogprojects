  <div class="footer">
    <a href="/blog" class="footer__link footer__link--home"><h5 class="footer__link--headline">jordanlewis.dev</h5></a>
    <a href="/blog/blogs" class="footer__link"><p>Blogs</p></a>
    <a href="/blog/projects" class="footer__link"><p>Projects</p></a>
<?php if($auth->signed_in): ?>
    <a href="/blog/edit_profile" class="footer__link"><p>Edit Profile</p></a>
    <a href="/blog/logout" class="footer__link"><p>Log Out</p></a>
<?php else: ?>
    <a href="/blog/login" class="footer__link"><p>Log In</p></a>
    <a href="/blog/signup" class="footer__link"><p>Sign Up</p></a>
<?php endif; ?>
    <a href="/blog/contact_me" class="footer__link"><p>Contact Me</p></a>
    <p class="footer__copyright">Copyright by Jordan Lewis &#169; 2021</p>
  </div>
</div>
</body>
<script src="/blog/includes/scripts.js"></script>
</html>