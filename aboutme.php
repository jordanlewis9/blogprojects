<?php require_once("includes/header.php"); ?>
<?php 
  $section1 = Blog::get_item_by_id('blogs', 9);
  $section2 = Blog::get_item_by_id('blogs', 10);
?>
  <div class="container__content">
    <h1 class="page__headline">About Me</h1>
    <section class="about-me">
      <div class="about-me__background">
        <img src="admin/images/<?php echo $section1->picture; ?>" class="about-me__picture" alt="<?php echo $section1->alt_text; ?>">
        <p class="about-me__paragraph"><?php echo $section1->content; ?><pp>
      </div>
      <div class="about-me__technical">
        <img src="admin/images/<?php echo $section2->picture; ?>" class="about-me__picture" alt="<?php echo $section2->alt_text; ?>">
        <p class="about-me__paragraph"><?php echo $section2->content; ?></p>
      </div>
    </section>
  </div>
</div>
<?php require_once("includes/footer.php"); ?>