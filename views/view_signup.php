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

      <h2>Signup here </h2>
      <?php
      if (isset($error_message)) {
      ?>
        <div class="error-message">
          <h3>
            Error
          </h3>
          <p>

            <?= urldecode($error_message) ?>
          </p>
        </div>
      <?php
      }

      ?>

      <form id="signup-form" method="POST" action="/signup" onsubmit="return validate();">
        <label for="user_name"> First name <i class="fas fa-user"></i></label>
        <input type="text" name="user_name" data-validate="str" data-min="2" data-max="50">
        <label for="user_last_name"> Last name<i class="fas fa-user"></i></label>
        <input type="text" name="user_last_name" data-validate="str" data-min="2" data-max="50">
        <label for="user_email"> Email <i class="fas fa-envelope"></i></label>
        <input type="text" name="user_email" data-validate="email" data-min="" data-max="">
        <label for="user_phone">Phone no. <i class="fas fa-phone-alt"></i></label>
        <input type="number" name="user_phone" data-validate="int" data-min="8" data-max="8">
        <label for="user_password">Password<i class="fas fa-lock"></i></i></label>
        <input type="password" name="user_password" data-validate="str" data-min="4" data-max="16">
        <!--     <span>
          <i class="fas fa-eye pw" name="user_password"></i>
        </span> -->
        <label for="user_confirm_password">Confirm Password<i class="fas fa-lock"></i></i></label>
        <input type="password" name="user_confirm_password" data-match-name="user_password" data-validate="match" data-min="4" data-max="16">
        <button>Signup</button>
        <div class="swap-login">Already have an account? <a href="/login">Login here!</a></div>
      </form>

    </div>
  </div>
</div>

<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_bottom.php');
