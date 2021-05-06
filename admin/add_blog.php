<?php require_once("includes/admin_header.php"); ?>
<?php

if (isset($_POST['submit'])) {
  $blog = new Blog;
  $blog->title = $_POST['title'];
  $blog->content = $_POST['content'];
  $blog->set_file($_FILES['picture']);
  $blog->new_blog();
}
?>

<form method="POST" action="" class="admin__form" enctype="multipart/form-data">
  <div class="admin__form--inputs" id="admin__form--picture-container">
    <p class="admin__form--picture-file">No File Selected</p>
    <label for="picture" class="admin__form--picture-label gen-btn">Upload Picture</label>
    <input type="file" name="picture" id="picture" accept=".png, .jpg, .jpeg">
  </div>
  <div class="admin__form--inputs">
    <label for="title">Title</label>
    <input type="text" name="title" id="title">
  </div>
  <div class="admin__form--inputs">
    <label for="content">Content</label>
<?php if (isset($message->blog_content)): ?>
    <input type="text" name="content" id="content" value="<?php echo $message->blog_content; ?>">
<?php else: ?>
    <input type="text" name="content" id="content">
<?php endif; ?>
  </div>
  <div class="admin__form--inputs">
    <input class="gen-btn" type="submit" name="submit" value="Add Blog" id="add_item">
  </div>
</form>

<?php require_once("includes/admin_footer.php"); ?>