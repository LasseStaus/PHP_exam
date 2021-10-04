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

      <h2>Please log in </h2>
      <?php
      if (isset($success_message)) {
      ?>
        <div class="error-message">
          <h3 class="success">
            Success!
          </h3>
          <p>
            <?= urldecode($success_message) ?>
          </p>
        </div>
      <?php
      }
      ?>
      <?php
      if (isset($error_message)) {
      ?>
        <div class="error-message">
          <h3>
            ERROR!
          </h3>
          <p>
            <?= urldecode($error_message) ?>
          </p>
        </div>
      <?php
      }
      ?>
      <form id="login-form" action="/login" method="POST" onsubmit="return validate()">
        <label for="login_user_email">Email<i class="fas fa-user"></i></label>
        <input name="login_user_email" type="text" data-validate="email">
        <label for="login_user_password">Password <i class="fas fa-lock"></i></label>
        <input name="login_user_password" maxlength="50" data-validate="str" data-min="2" data-max="50" type="password">
        <button for="login-form" type="submit">
          login
        </button>
        <div class="button-container">
          <a class="button" href="/lost-password" class="forgotpw">Forgot your password?</a>

          <a class="button blue" href="/signup">Sign up here!</a>
        </div>
      </form>
    </div>
    <div class="swap-login">
      <a href="/admin-login">Go to admin login</a>
    </div>

  </div>
</div>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_bottom.php');
?>