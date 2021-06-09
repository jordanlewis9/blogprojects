<?php require_once("includes/admin_header.php"); ?>
<?php

if (isset($_GET['project_id'])) {
  $project = Project::get_item_by_id("projects", $_GET['project_id']);
}

if (isset($_POST['update'])) {
  $project->alt_text = $_POST['alt_text'];
  $project->title = $_POST['title'];
  $project->snippet = $_POST['snippet'];
  $project->description = $_POST['description'];
  $project->link = $_POST['link'];
  if (empty($_FILES['picture']['name'])) {
    $project->update_project();
  } else {
    $project->set_file($_FILES['picture']);
    $project->update_project();
  }
}

?>

<form method="POST" action="" class="admin__form" enctype="multipart/form-data">
  <div class="admin__form--inputs" id="admin__form--picture-container">
    <img class="admin__form--picture-preview" src="images/<?php echo $project->picture; ?>">
    <p class="admin__form--picture-file"><?php echo $project->picture; ?></p>
    <label for="picture" class="admin__form--picture-label gen-btn">Upload Picture</label>
    <input type="file" name="picture" id="picture" accept=".png, .jpg, .jpeg">
  </div>
  <div class="admin__form--inputs">
    <label for="alt_text">Alt Text</label>
    <input type="text" name="alt_text" id="author" maxlength="256" value="<?php echo $project->alt_text; ?>">
  </div>
  <div class="admin__form--inputs">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="<?php echo $project->title; ?>">
  </div>
  <div class="admin__form--inputs">
    <label for="description">Description</label>
    <textarea name="description" id="description" rows="4" cols="40"><?php echo $project->description; ?></textarea>
  </div>
  <div class="admin__form--inputs">
    <label for="snippet">Snippet</label>
    <textarea id="snippet" name="snippet" rows="4" cols="40"><?php echo $project->snippet; ?></textarea>
  </div>
  <div class="admin__form--inputs">
    <label for="link">Link</label>
    <input type="text" name="link" id="link" value="<?php echo $project->link; ?>">
  </div>
  <div class="admin__form--inputs">
    <a href="delete_item.php?project_id=<?php echo $project->id; ?>" class="gen-btn admin__form--delete">Delete</a>
    <input class="gen-btn" type="submit" name="update" value="Update Project">
  </div>
</form>

<?php require_once("includes/admin_footer.php"); ?>