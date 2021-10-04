<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_top_required.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_body_main.php');
?>



<div class="content-container-login">

  <?php
  include('views/view_hero.php');
  ?>
  <div class="form-wrapper">


    <div class="form-container">
      <?php
      if (isset($error_message)) {
      ?>
        <div>
          ERROR <?= urldecode($error_message) ?>
        </div>
      <?php
      }

      ?>
      <?php
      if (isset($success_message)) {
      ?>
        <div>
          Success <?= urldecode($success_message) ?>
        </div>
      <?php
      }

      ?>
      <h2>Admin Login</h2>
      <form action="/admin-login" method="POST" onsubmit="return validate()">
        <label for="admin_user_email">Email <i class="fas fa-user"></i></label>
        <input name="admin_user_email" type="text" data-validate="email">
        <label for="admin_user_password">Password <i class="fas fa-lock"></i></label>
        <input name="admin_user_password" type="password" maxlength="50" data-validate="str" data-min="2" data-max="50">
        <button>
          login
        </button>

        <div class="swap-login">Login as a member? <a href="/login">Swap here</a></div>
      </form>
    </div>
  </div>
</div>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_bottom.php');
?>