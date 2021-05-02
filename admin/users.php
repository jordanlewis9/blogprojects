<?php require_once("includes/admin_header.php"); ?>
<?php 
$all_users = User::get_all_items("users");
?>
<div class="users__container">
  <a href="add_user.php" class="admin__add-button gen-btn">Add User</a>
  <table class="admin__table">
    <tr class="admin__table--header-row">
      <th class="admin__table--heading">ID</th>
      <th class="admin__table--heading">Username</th>
      <th class="admin__table--heading">Email</th>
      <th class="admin__table--heading">Role</th>
      <th class="admin__table--heading">Edit</th>
      <th class="admin__table--heading">Delete</th>
    </tr>
<?php
foreach ($all_users as $user) {
  echo "
  <tr class='admin__table--row'>
    <td class='admin__table--entry'>{$user->id}</td>
    <td class='admin__table--entry'>{$user->username}</td>
    <td class='admin__table--entry'>{$user->email}</td>
    <td class='admin__table--entry'>{$user->role}</td>
    <td class='admin__table--entry'><a href='edit_user.php?user_id={$user->id}'>Edit</a></td>
    <td class='admin__table--entry'><a href='#' data-id='{$user->id}' data-table='user' data-single='{$user->username}' class='delete__link'>Delete</td>
  </tr>
  ";
}
?>
  </table>
</div>
</div>
<?php require_once("includes/delete_modal.php"); ?>
<?php require_once("includes/admin_footer.php"); ?>