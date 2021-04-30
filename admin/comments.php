<?php require_once("includes/admin_header.php"); ?>
<?php 
$all_comments = Comment::get_all_items("comments");
?>
<div class="comments__container">
  <table class="admin__table">
    <tr class="admin__table--header-row">
      <th class="admin__table--heading">ID</th>
      <th class="admin__table--heading">Username</th>
      <th class="admin__table--heading">Preview</th>
      <th class="admin__table--heading">Status</th>
      <th class="admin__table--heading">Approve</th>
      <th class="admin__table--heading">Deny</th>
      <th class="admin__table--heading">Edit</th>
      <th class="admin__table--heading">Delete</th>
    </tr>
<?php
foreach ($all_comments as $user) {
  echo "
  <tr class='admin__table--row'>
    <td class='admin__table--entry'>{$comment->id}</td>
    <td class='admin__table--entry'>{$comment->username}</td>
    <td class='admin__table--entry'>{$comment->preview}</td>
    <td class='admin__table--entry'>{$comment->status}</td>
    <td class='admin__table--entry'><a href='#'>Approve</a></td>
    <td class='admin__table--entry'><a href='#'>Deny</a></td>
    <td class='admin__table--entry'><a href='edit_comment.php?comment_id={$comment->id}'>Edit</a></td>
    <td class='admin__table--entry'><a href='#' data-id='{$comment->id}' data-table='comment' data-single='{$comment->id}' class='delete__link'>Delete</td>
  </tr>
  ";
}
?>
  </table>
</div>
</div>
<?php require_once("includes/delete_modal.php"); ?>
<?php require_once("includes/admin_footer.php"); ?>