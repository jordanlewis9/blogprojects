<?php require_once("includes/admin_header.php"); ?>
<?php 
if (isset($_GET['page'])) {
  $paginate = new Paginate(Comment::count_items('comments'), 25, $_GET['page']);
} else {
  $paginate = new Paginate(Comment::count_items('comments'), 25, 1);
}
$all_comments = Comment::get_all_comments($paginate->return_offset(), $paginate->num_per_page);
?>
<h2 class="admin__headline">Comments</h2>
<div class="comments__container">
  <table class="admin__table">
    <tr class="admin__table--header-row">
      <th class="admin__table--heading">ID</th>
      <th class="admin__table--heading">Username</th>
      <th class="admin__table--heading">Created at</th>
      <th class="admin__table--heading">For Blog...</th>
      <th class="admin__table--heading">Status</th>
      <th class="admin__table--heading">Approve</th>
      <th class="admin__table--heading">Deny</th>
      <th class="admin__table--heading">Edit</th>
      <th class="admin__table--heading">Delete</th>
    </tr>
<?php
foreach ($all_comments as $comment) {
  echo "
  <tr class='admin__table--row'>
    <td class='admin__table--entry'>{$comment->id}</td>
    <td class='admin__table--entry'>{$comment->username}</td>
    <td class='admin__table--entry'>{$comment->created}</td>
    <td class='admin__table--entry'>{$comment->title}</td>
    <td class='admin__table--entry'>{$comment->status}</td>
    <td class='admin__table--entry'><a href='comment_action.php?comment_id={$comment->id}&status=approved'>Approve</a></td>
    <td class='admin__table--entry'><a href='comment_action.php?comment_id={$comment->id}&status=denied'>Deny</a></td>
    <td class='admin__table--entry'><a href='edit_comment.php?comment_id={$comment->id}'>Edit</a></td>
    <td class='admin__table--entry'><a href='#' data-id='{$comment->id}' data-table='comment' data-single='{$comment->id}' class='delete__link'>Delete</td>
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