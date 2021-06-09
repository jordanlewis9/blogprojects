<?php require_once("includes/admin_header.php"); ?>
<?php 
if (isset($_POST['submit'])) {
  $project = new Project;
  $project->alt_text = $_POST['alt_text'];
  $project->title = $_POST['title'];
  $project->description = $_POST['description'];
  $project->snippet = $_POST['snippet'];
  $project->link = $_POST['link'];
  $project->set_file($_FILES['picture']);
  $project->new_project();
}
?>

<form method="POST" action="" class="admin__form" enctype="multipart/form-data">
  <div class="admin__form--inputs" id="admin__form--picture-container">
    <p class="admin__form--picture-file">No File Selected</p>
    <label for="picture" class="admin__form--picture-label gen-btn">Upload Picture</label>
    <input type="file" name="picture" id="picture" accept=".png, .jpg, .jpeg">
  </div>
  <div class="admin__form--inputs">
    <label for="alt_text">Alt Text</label>
    <input type="text" name="alt_text" id="author" maxlength="256">
  </div>
  <div class="admin__form--inputs">
    <label for="title">Title</label>
    <input type="text" name="title" id="title">
  </div>
  <div class="admin__form--inputs">
    <label for="description">Description</label>
    <textarea name="description" id="description" rows="4" cols="40"></textarea>
  </div>
  <div class="admin__form--inputs">
    <label for="snippet">Snippet</label>
    <textarea id="snippet" name="snippet" rows="4" cols="40"></textarea>
  </div>
  <div class="admin__form--inputs">
    <label for="link">Link</label>
    <input type="text" name="link" id="link">
  </div>
  <div class="admin__form--inputs">
    <input class="gen-btn" type="submit" name="submit" value="Add Project" id="add_item">
  </div>
</form>

<?php require_once("includes/admin_footer.php"); ?>