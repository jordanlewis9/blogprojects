<?php require_once("includes/admin_header.php"); ?>
<?php
  if (isset($_POST['submit'])) {
    $clean_input = new Clean_Input;
    $new_user = new User;
    $clean_input->isValid[] = $new_user->username = $clean_input->validate_username($_POST['username']);
    $clean_input->isValid[] = $new_user->email = $clean_input->validate_email($_POST['email']);
    $clean_input->isValid[] = $new_user->first_name = $clean_input->validate_name($_POST['first_name']);
    $clean_input->isValid[] = $new_user->last_name = $clean_input->validate_name($_POST['last_name']);
    $clean_input->isValid[] = $new_user->password = $clean_input->validate_password($_POST['password']);
    if (in_array(false, $clean_input->isValid, true)) {
      redirect("add_user.php");
    } else {
      $new_user->add_user();
    }
  }
?>

<form method="POST" action="" class="admin__form" id="admin-user-form">
  <div class="admin__form--inputs">
    <label for="username">Username</label>
    <div class="admin__input--container">
      <input type="text" name="username" id="username">
    </div>
  </div>
  <div class="admin__form--inputs">
    <label for="email">Email</label>
    <div class="admin__input--container">
      <input type="email" name="email" id="email">
    </div>
  </div>
  <div class="admin__form--inputs">
    <label for="first_name">First Name</label>
    <div class="admin__input--container">
      <input type="text" name="first_name" id="first_name">
    </div>
  </div>
  <div class="admin__form--inputs">
    <label for="last_name">Last Name</label>
    <div class="admin__input--container">
      <input type="text" name="last_name" id="last_name">
    </div>
  </div>
  <div class="admin__form--inputs">
    <label for="password">Password</label>
    <div class="admin__input--container">
      <input type="password" name="password" id="password">
    </div>
  </div>
  <div class="admin__form--inputs">
    <input class="gen-btn" type="submit" name="submit" value="Add User" id="add_item">
  </div>
</form>

<?php require_once("includes/admin_footer.php"); ?>