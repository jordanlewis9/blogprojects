<?php require_once("includes/admin_header.php"); ?>
<?php
if ($num_blogs = Blog::count_items('blogs')) {
  if (isset($_GET['page'])) {
    $paginate = $paginate = new Paginate($num_blogs, 25, $_GET['page']);
  } else {
    $paginate = new Paginate($num_blogs, 25, 1);
  }
    $all_blogs = Blog::get_all_items("blogs", $paginate->return_offset(), $paginate->num_per_page);
}
?>
<h2 class="admin__headline">Blogs</h2>
<div class="blogs__container">
<a href="add_blog.php" class="admin__add-button gen-btn">Add Blog</a>
<?php if ($num_blogs): ?>
  <table class="admin__table">
    <tr class="admin__table--header-row">
      <th class="admin__table--heading">ID</th>
      <th class="admin__table--heading">Title</th>
      <th class="admin__table--heading">Views</th>
      <th class="admin__table--heading">Created On</th>
      <th class="admin__table--heading">Updated</th>
      <th class="admin__table--heading">Edit</th>
      <th class="admin__table--heading">Delete</th>
    </tr>
<?php
foreach ($all_blogs as $blog) {
  $blog->updated = $blog->updated === "0" ? "No" : "Yes";
  echo "
  <tr class='admin__table--row'>
    <td class='admin__table--entry'>{$blog->id}</td>
    <td class='admin__table--entry'><a href='/blog/blogs/{$blog->id}'>{$blog->title}</a></td>
    <td class='admin__table--entry'>{$blog->views}</td>
    <td class='admin__table--entry'>{$blog->created}</td>
    <td class='admin__table--entry'>{$blog->updated}</td>
    <td class='admin__table--entry'><a href='edit_blog.php?blog_id={$blog->id}'>Edit</a></td>
    <td class='admin__table--entry'><a href='#' data-id='{$blog->id}' data-table='blog' data-single='{$blog->title}' class='delete__link'>Delete</td>
  </tr>
  ";
}
?>
  </table>
  <?php $paginate->show_pagination(); ?>
<?php else: ?>
  <p>No blogs published to display</p>
<?php endif; ?>
</div>
</div>
<?php require_once("includes/delete_modal.php"); ?>
<?php require_once("includes/admin_footer.php"); ?>