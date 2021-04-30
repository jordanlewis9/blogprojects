<?php require_once("includes/admin_header.php"); ?>
<?php

if (isset($_GET['blog_id'])) {
  $blog = Blog::get_item_by_id("blogs", $_GET['blog_id']);
}

if (isset($_POST['update'])) {
  $blog->title = $_POST['title'];
  $blog->content = $_POST['content'];
  if (empty($_FILES['picture']['name'])) {
    $blog->update_blog();
  } else {
    if ($blog->set_file($_FILES['picture'])) {
      $blog->update_blog();
    } else {
      print_r($_FILES);
    }
  }
}

?>

<form method="POST" action="" class="admin__form" enctype="multipart/form-data">
  <div class="admin__form--inputs" id="admin__form--picture-container">
    <img class="admin__form--picture-preview" src="images/<?php echo $blog->picture; ?>">
    <p class="admin__form--picture-file"><?php echo $blog->picture; ?></p>
    <label for="picture" class="admin__form--picture-label gen-btn">Upload Picture</label>
    <input type="file" name="picture" id="picture" accept=".png, .jpg, .jpeg">
  </div>
  <div class="admin__form--inputs">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="<?php echo $blog->title; ?>">
  </div>
  <div class="admin__form--inputs">
    <label for="content">Content</label>
    <input type="text" name="content" id="content" value="<?php echo $blog->content; ?>">
  </div>
  <div class="admin__form--inputs">
    <input class="gen-btn" type="submit" name="update" value="Update Blog">
  </div>
</form>

<?php require_once("includes/admin_footer.php"); ?>