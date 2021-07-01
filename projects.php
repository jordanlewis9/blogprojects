<?php require_once("includes/header.php"); ?>
<?php
  if (isset($_GET['page'])) {
    $paginate = new Paginate(Project::count_items('projects'), 10, $_GET['page']);
  } else {
    $paginate = new Paginate(Project::count_items('projects'), 10, 1);
  }

  $all_projects = Project::get_all_items('projects', $paginate->return_offset(), $paginate->num_per_page);
?>
  <div class="container__content">
    <h1 class="page__headline">Projects</h1>
<?php
  foreach($all_projects as $project) {
    echo "
    <section class='content__section'>
      <div class='content__section--content'>
        <a href='/blog/projects/{$project->id}' class='content__section--link content__section--link-title'><h2 class='content__section--title'>{$project->title}</h2></a>
        <p class='content__section--snippet'>{$project->snippet}</p>
      </div>
      <a href='/blog/projects/{$project->id}' class='content__section--link content__section--link-picture'><img src='/blog/admin/images/{$project->picture}' class='content__section--image' alt='{$project->alt_text}'></a>
    </section>
    <hr>
    ";
  }
?>
<?php $paginate->show_pagination(); ?>
  </div>
</div>
<?php require_once("includes/footer.php"); ?>