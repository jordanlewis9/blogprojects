<?php require_once("includes/admin_header.php"); ?>
<?php

if (isset($_GET['blog_id'])) {
  $blog = Blog::get_item_by_id("blogs", $_GET['blog_id']);
}

if (isset($_POST['update'])) {
  $blog->title = $_POST['title'];
  $blog->author = $_POST['author'];
  $blog->content = $_POST['content'];
  if (empty($_FILES['picture']['name'])) {
    $blog->update_blog();
  } else {
    $blog->set_file($_FILES['picture']);
    $blog->update_blog();
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
  <div class="admin__form--inputs-blog">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="<?php echo $blog->title; ?>">
  </div>
  <div class="admin__form--inputs-blog">
    <label for="author">Author</label>
    <input type="text" name="author" id="author" value="<?php echo $blog->author; ?>">
  </div>
  <div class="admin__form--inputs-blog">
    <label for="content">Content</label>
    <textarea class="editor" name="content" id="content"><?php echo $blog->content; ?></textarea>
  </div>
  <div class="admin__form--inputs">
    <a href="delete_item.php?blog_id=<?php echo $blog->id; ?>" class="gen-btn admin__form--delete">Delete</a>
    <input class="gen-btn" type="submit" name="update" value="Update Blog">
  </div>
</form>

<?php require_once("includes/admin_footer.php"); ?>