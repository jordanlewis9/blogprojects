<?php require_once("includes/admin_header.php"); ?>
<?php

if (isset($_GET['blog_id'])) {
  $blog = Blog::get_item_by_id("blogs", $_GET['blog_id']);
}

if (isset($_POST['update'])) {
  $clean_input = new Clean_Input;
  $clean_input->isValid[] = $blog->alt_text = $clean_input->validate_content($_POST['alt_text'], 'alt_text');
  $clean_input->isValid[] = $blog->title = $clean_input->validate_content($_POST['title'], 'title');
  $blog->content = $_POST['content'];
  $clean_input->isValid[] = $blog->author = $clean_input->validate_content($_POST['author'], 'author');
  if (in_array(false, $clean_input->isValid, true)) {
    redirect("edit_blog.php?blog_id={$blog->id}");
  }
  if (empty($_FILES['picture']['name'])) {
    $blog->update_blog();
  } else {
    $blog->set_file($_FILES['picture']);
    $blog->update_blog();
  }
}

?>

<form method="POST" action="" class="admin__form" id="admin-blog-form" enctype="multipart/form-data">
  <div class="admin__form--inputs" id="admin__form--picture-container">
    <img class="admin__form--picture-preview" src="images/<?php echo $blog->picture; ?>">
    <p class="admin__form--picture-file"><?php echo $blog->picture; ?></p>
    <label for="picture" class="admin__form--picture-label gen-btn">Upload Picture</label>
    <input type="file" name="picture" id="picture" accept=".png, .jpg, .jpeg">
  </div>
  <div class="admin__form--inputs-blog">
    <label for="alt_text">Alt Text</label>
    <div class="admin__input--container">
      <input type="text" name="alt_text" id="author" value="<?php echo $blog->alt_text; ?>" maxlength="256">
    </div>
  </div>
  <div class="admin__form--inputs-blog">
    <label for="title">Title</label>
    <div class="admin__input--container">
      <input type="text" name="title" id="title" value="<?php echo $blog->title; ?>">
    </div>
  </div>
  <div class="admin__form--inputs-blog">
    <label for="author">Author</label>
    <div class="admin__input--container">
      <input type="text" name="author" id="author" value="<?php echo $blog->author; ?>">
    </div>
  </div>
  <div class="admin__form--inputs-blog">
    <label for="content">Content</label>
    <div class="admin__input--container">
      <textarea class="editor" name="content" id="content"><?php echo $blog->content; ?></textarea>
    </div>
  </div>
  <div class="admin__form--inputs">
    <a href="delete_item.php?blog_id=<?php echo $blog->id; ?>" class="gen-btn admin__form--delete">Delete</a>
    <input class="gen-btn" type="submit" name="update" value="Update Blog">
  </div>
</form>

<?php require_once("includes/admin_footer.php"); ?>