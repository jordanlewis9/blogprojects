<?php
require_once("includes/header.php");
?>
  <div class="container">
<?php if(isset($message->current_message)): ?>
  <p><?php echo $message->current_message; ?></p>
<?php endif; ?>
    <div class="container__content">
      <section>
        <h2 class="home__header">Latest Blog Post</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pretium maximus nisl. Nunc id nibh felis. Nullam at quam ornare.</p>
      </section>
      <section>
        <h2 class="home__header">Checkout this randomly generated project!</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pretium maximus nisl. Nunc id nibh felis. Nullam at quam ornare.</p>
      </section>
    </div>
  </div>
<?php
require_once("includes/footer.php");
?>