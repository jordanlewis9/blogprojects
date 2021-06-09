<?php require_once("includes/admin_header.php"); ?>
<?php

if (isset($_POST['submit'])) {
  $blog = new Blog;
  $blog->alt_text = $_POST['alt_text'];
  $blog->title = $_POST['title'];
  $blog->content = $_POST['content'];
  $blog->author = $_POST['author'];
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
  <div class="admin__form--inputs-blog">
    <label for="alt_text">Alt Text</label>
    <input type="text" name="alt_text" id="author" maxlength="256">
  </div>
  <div class="admin__form--inputs-blog">
    <label for="title">Title</label>
    <input type="text" name="title" id="title">
  </div>
  <div class="admin__form--inputs-blog">
    <label for="author">Author</label>
    <input type="text" name="author" id="author">
  </div>
  <div class="admin__form--inputs-blog">
    <label for="content">Content</label>
<?php if (isset($message->blog_content)): ?>
    <textarea name="content" class="editor" id="content" cols="40" rows="8"><?php echo $message->blog_content; ?></textarea>
<?php else: ?>
    <textarea name="content" class="editor" id="content" cols="40" rows="8"></textarea>
<?php endif; ?>
  </div>
  <div class="admin__form--inputs">
    <input class="gen-btn" type="submit" name="submit" value="Publish Blog" id="add_item">
  </div>
</form>

<?php require_once("includes/admin_footer.php"); ?>