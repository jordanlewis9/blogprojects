<?php if (count($comments) >= 1) {
  foreach ($comments as $comment) {
    $comment->format_time();
    echo "
    <section class='comment'>
      <p class='comment__username'>{$comment->username}</p>
      <p class='comment__created'>{$comment->created}</p>
      <p class='comment__content'>{$comment->content}</p>
    </section>
    ";
  }
}
?>
</div>
<?php if ($auth->signed_in): ?>
  <form method="POST" action="" class="comment__form">
    <label for="comment" class="comment__form--label">Enter Comment</label>
    <textarea id="comment" name="comment" rows="6" placeholder="Enter comment here..." class="comment__form--content"></textarea>
    <input type="submit" name="submit" value="Post Comment" class="gen-btn comment__form--button">
  </form>
<?php else: ?>
  <p><a href="signup.php" class="cta-link">Sign up</a> or <a href="login.php" class="cta-link">login</a> to comment on this post.</p>
<?php endif; ?>