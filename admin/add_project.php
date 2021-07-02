<?php require_once("includes/admin_header.php"); ?>
<?php 
if (isset($_POST['submit'])) {
  $clean_input = new Clean_Input;
  $project = new Project;
  $clean_input->isValid[] = $project->alt_text = $clean_input->validate_content($_POST['alt_text'], 'alt_text');
  $clean_input->isValid[] = $project->title = $clean_input->validate_content($_POST['title'], 'title');
  $clean_input->isValid[] = $project->description = $clean_input->validate_content($_POST['description'], 'description');
  $clean_input->isValid[] = $project->snippet = $clean_input->validate_content($_POST['snippet'], 'snippet');
  $clean_input->isValid[] = $project->link = $clean_input->validate_content($_POST['link'], 'link');
  if (in_array(false, $clean_input->isValid, true)) {
    redirect("add_project.php");
  }
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
    <div class="admin__input--container">
      <input type="text" name="alt_text" id="author" maxlength="256">
    </div>
</div>
  <div class="admin__form--inputs">
    <label for="title">Title</label>
    <div class="admin__input--container">
      <input type="text" name="title" id="title">
    </div>
</div>
  <div class="admin__form--inputs">
    <label for="description">Description</label>
    <div class="admin__input--container">
      <textarea name="description" id="description" rows="4" cols="40"></textarea>
    </div>
</div>
  <div class="admin__form--inputs">
    <label for="snippet">Snippet</label>
    <div class="admin__input--container">
      <textarea id="snippet" name="snippet" rows="4" cols="40"></textarea>
    </div>
</div>
  <div class="admin__form--inputs">
    <label for="link">Link</label>
    <div class="admin__input--container">
      <input type="text" name="link" id="link">
    </div>
</div>
  <div class="admin__form--inputs">
    <input class="gen-btn" type="submit" name="submit" value="Add Project" id="add_item">
  </div>
</form>

<?php require_once("includes/admin_footer.php"); ?>