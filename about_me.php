<?php require_once("includes/header.php"); ?>
<?php 
  $section1 = Blog::get_item_by_id('blogs', 9);
  $section2 = Blog::get_item_by_id('blogs', 10);
?>
  <div class="container__content">
    <h1 class="page__headline">About Me</h1>
    <section class="about-me">
      <div class="about-me__background">
        <div class="about-me__picture--container">
          <img src="/blog/admin/images/<?php echo $section1->picture; ?>" class="about-me__picture" alt="<?php echo $section1->alt_text; ?>">
        </div>
        <div class="about-me__paragraph"><?php echo $section1->content; ?></div>
      </div>
      <div class="about-me__technical">
        <div class="about-me__picture--container about-me__picture--tech-container">
          <img src="/blog/admin/images/<?php echo $section2->picture; ?>" class="about-me__picture about-me__picture--tech" alt="<?php echo $section2->alt_text; ?>">
        </div>
        <div class="about-me__paragraph about-me__paragraph--tech"><?php echo $section2->content; ?></div>
      </div>
    </section>
  </div>
</div>
<?php require_once("includes/footer.php"); ?>