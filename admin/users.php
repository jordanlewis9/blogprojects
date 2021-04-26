<?php require_once("includes/admin_header.php"); ?>
<?php 
$all_users = User::get_all_items("users");
?>
<a href="add_user.php" class="admin__add-button">Add User</a>
  <table class="admin__table">
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Role</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
<?php
foreach ($all_users as $user) {
  echo "
  <tr>
    <th>{$user->id}</th>
    <th>{$user->username}</th>
    <th>{$user->first_name}</th>
    <th>{$user->last_name}</th>
    <th>{$user->role}</th>
    <th><a href='edit_user.php?user_id={$user->id}'>Edit</a></th>
    <th><a href='#' data-id='{$user->id}' data-table='user' data-single='{$user->username}' class='delete__link'>Delete</th>
  </tr>
  ";
}
?>
  </table>
</div>
<?php require_once("includes/delete_modal.php"); ?>
<?php require_once("includes/admin_footer.php"); ?>