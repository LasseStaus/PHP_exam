<?php
if (!isset($_SESSION)) {
  session_start();
}

if (!isset($_SESSION['admin_uuid'])) {
  header('Location: /admin-login');
  exit();
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_admin_top.php');
?>

<div class="content-container admin">

  <div class="form-wrapper">

    <div class="account-content">


      <div class="form-container">

        <h3>Admin reset login</h3>
        <form action="/admin-create-new-password" method="POST" onsubmit="return validate()">
          <label for="admin_user_email">Email <i class="fas fa-user"></i></label>
          <input name="admin_user_email" type="text" value="<?= $_SESSION['admin_email'] ?>" data-validate="email">
          <label for="admin_user_password">Password <i class="fas fa-lock"></i></label>
          <input name="admin_user_password" type="password" maxlength="50" data-validate="str" data-min="2" data-max="50">

          <label for="admin_user_confirm_password">Confirm Password <i class="fas fa-lock"></i></i></label>
          <input type="password" name="admin_user_confirm_password" data-validate="str" data-min="4" data-max="16">


          <button>
            Reset your password, Mr. Admin
          </button>

        </form>
      </div>
    </div>
  </div>
</div>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_bottom.php');
?>