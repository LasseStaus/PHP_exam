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

            <h2>Enter your email</h2>


            <form action="/lost-password-mail" method="POST" onsubmit="return validate()">
                <label for="user_email">Email <i class="fas fa-user"></i></label>
                <input name="user_email" type="text" data-validate="email">

                <button>
                    Send request
                </button>
                <div class="swap-login"><a href="/login">Back to login!</a></div>

            </form>



            <?php

            if (isset($success_message)) {
            ?>
                <div class="message">
                    <h3>Success!</h3>
                    <p>A message has been sent to:</p>
                    <p class="bold">
                        <?= urldecode($success_message) ?>



                    </p>

                    <a href="/login" class="button blue small">Go to login.</a>
                </div>
            <?php
            }

            ?>

        </div>
    </div>
</div>


<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_bottom.php');
?>