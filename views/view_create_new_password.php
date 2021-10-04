<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_top_required.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_body_main.php');


?>

<div class="content-container">
    <?php
    include('views/view_hero.php');
    ?>
    <div class="form-wrapper">
        <div class="form-container">
            <h2>Create a new password</h2>
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


            <form action="/create-new-password" method="POST" onsubmit="return validate()">
                <label for="user_email">Email<i class="fas fa-user"></i></label>
                <input name="user_email" type="text" data-validate="email">
                <label for="user_password">Password<i class="fas fa-lock"></i></label>
                <input name="user_password" type="password" maxlength="50" data-validate="str" data-min="2" data-max="50">
                <label for="user_confirm_password">Confirm Password<i class="fas fa-lock"></i></i></label>
                <input type="password" name="user_confirm_password" data-validate="str" data-min="4" data-max="16">
                <button>
                    Update Password
                </button>
                <div class="swap-login">
                    <a href="/login">Go back</a>
                </div>

            </form>


        </div>
    </div>
</div>


<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_bottom.php');
?>