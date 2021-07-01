<?php require_once("includes/admin_header.php"); ?>
<?php 
if (isset($_GET['page'])) {
  $paginate = $paginate = new Paginate(Project::count_items('projects'), 25, $_GET['page']);
} else {
  $paginate = new Paginate(Project::count_items('projects'), 25, 1);
}
$all_projects = Project::get_all_items("projects", $paginate->return_offset(), $paginate->num_per_page); ?>
<h2 class="admin__headline">Projects</h2>
<div class="projects__container">
<a href="add_project.php" class="admin__add-button gen-btn">Add Project</a>
  <table class="admin__table">
    <tr class="admin__table--header-row">
      <th class="admin__table--heading">ID</th>
      <th class="admin__table--heading">Project</th>
      <th class="admin__table--heading">Snippet</th>
      <th class="admin__table--heading">Edit</th>
      <th class="admin__table--heading">Delete</th>
    </tr>
<?php
foreach ($all_projects as $project) {
  echo "
  <tr class='admin__table--row'>
    <td class='admin__table--entry'>{$project->id}</td>
    <td class='admin__table--entry'>{$project->title}</td>
    <td class='admin__table--entry'>{$project->snippet}</td>
    <td class='admin__table--entry'><a href='edit_project.php?project_id={$project->id}'>Edit</a></td>
    <td class='admin__table--entry'><a href='#' data-id='{$project->id}' data-table='project' data-single='{$project->title}' class='delete__link'>Delete</td>
  </tr>
  ";
}
?>
  </table>
  <?php $paginate->show_pagination(); ?>
</div>
</div>
<?php require_once("includes/delete_modal.php"); ?>
<?php require_once("includes/admin_footer.php"); ?>