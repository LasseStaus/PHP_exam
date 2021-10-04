<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/router.php');

get('/', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_index.php');
});

get('/logout', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/bridges/bridge_logout.php');
});

// #########################################################
// ################### 'GET' FOR USER ######################
// #########################################################


get('/signup_welcome_email/:user_confirmation_key/:email_recipient', 'serve_signup_confirmation_email');
function serve_signup_confirmation_email($user_confirmation_key, $recipient)
{
  $user_confirmation_key = $user_confirmation_key;
  $recipient = $recipient;
  require_once(__DIR__ . '/apis/api_signup_email.php');
  exit();
}

get('/main-feed', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_main_feed.php');
});
get('/view-user-profile/:user_uuid', function ($user_uuid) {
  $user_uuid = $user_uuid;
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_user_profile.php');
});


get('/users-feed', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_users_feed.php');
});


get('/login', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_login.php');
});

get('/login/error/:message', 'render_login_error');
function render_login_error($message)
{
  $error_message = $message;
  require_once(__DIR__ . '/views/view_login.php');
  exit();
}
get('/login/success/:message', 'render_login_success');
function render_login_success($success_message)
{
  $success_message = $success_message;
  require_once(__DIR__ . '/views/view_login.php');
  exit();
}

get('/account', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_account.php');
});
get('/account-edit', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_account_edit.php');
});

get('/signup', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_signup.php');
});

get('/signup/error/:message', 'render_signup_error');
function render_signup_error($error_message)
{
  $error_message = $error_message;
  require_once(__DIR__ . '/views/view_signup.php');
  exit();
};

get('/confirm/:user_confirmation_key', function ($user_confirmation_key) {
  $user_confirmation_key = $user_confirmation_key;

  require_once($_SERVER['DOCUMENT_ROOT'] . '/bridges/bridge_confirm_user.php');
});

get('/lost-password', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_new_password.php');
});
get('/lost-password/success/:message', 'render_success_message');
function render_success_message($success_message)
{
  $success_message = $success_message;
  require_once(__DIR__ . '/views/view_new_password.php');
  exit();
};

get('/create-new-password/:user_email', function ($user_email) {
  $user_email = $user_email;
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_create_new_password.php');
});
get('/create-new-password/error/:message', function ($error_message) {
  $error_message = $error_message;

  require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_create_new_password.php');
});

// #########################################################
// #################### 'GET' FOR ADMIN ####################
// #########################################################

get('/admin-page', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_admin_page.php');
});
get('/admin-edit-details', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_admin_edit_details.php');
});

get('/admin-users', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_admin_users.php');
});

get('/admin-login', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_admin_login.php');
});

get('/admin-login/error/:message', 'render_admin_login_error');
function render_admin_login_error($message)
{
  $error_message = $message;
  require_once(__DIR__ . '/views/view_admin_login.php');
  exit();
}
get('/admin-login/password/:message', 'render_admin_password_success');
function render_admin_password_success($success_message)
{
  $success_message = $success_message;
  require_once(__DIR__ . '/views/view_admin_login.php');
  exit();
}

// #########################################################
// #########################################################
// ###################### ALL POSTS ########################
// #########################################################
// #########################################################
/* 
post('/search', 'apis/api_search.php'); */

post('/search', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/apis/api_search.php');
});
// #########################################################
// ################### 'POST' FOR USER #####################
// #########################################################
post('/login', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/bridges/bridge_login.php');
});

post('/delete-account/:user_id', function ($user_id) {
  $user_id = $user_id;
  require_once($_SERVER['DOCUMENT_ROOT'] . '/bridges/bridge_delete_account.php');
});

post('/check-post/:user_uuid', function ($user_uuid) {
  $user_uuid = $user_uuid;
  require_once($_SERVER['DOCUMENT_ROOT'] . '/bridges/bridge_check_post.php');
});
post('/signup', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/bridges/bridge_signup.php');
});

post('/update-user-account', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/bridges/bridge_update_user_account.php');
});

post('/upload-profile-image', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/bridges/bridge_upload_profile_image.php');
});
post('/lost-password-mail', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/bridges/bridge_send_lost_password_mail.php');
});
post('/create-new-password', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/bridges/bridge_create_new_password.php');
});
// ######### POST LIKES #########
post('/posts/:post_id/:like_or_dislike', function ($post_id, $like_or_dislike) {
  $post_id =   $post_id;
  $like_or_dislike =   $like_or_dislike;
  require_once($_SERVER['DOCUMENT_ROOT'] . '/apis/api_posts_like_or_dislike.php');
});


// #########################################################
// ################### 'POST' FOR ADMIN ####################
// #########################################################

post('/admin-login', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/bridges/bridge_admin_login.php');
});

post('/admin-create-new-password', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/bridges/bridge_admin_create_new_password.php');
});


post('/users/delete/:user_id', function ($user_id) {
  $user_id = $user_id;
  require_once($_SERVER['DOCUMENT_ROOT'] . '/apis/api_delete_user.php');
  /*  require_once($_SERVER['DOCUMENT_ROOT'] . '/apis/api_blocked_user_email.php'); */
});


post('/users/block/:user_email', function ($user_email) {
  $user_email = $user_email;

  require_once($_SERVER['DOCUMENT_ROOT'] . '/bridges/bridge_block_user.php');
  /* require_once($_SERVER['DOCUMENT_ROOT'] . '/apis/api_block_user_email.php'); */
});

// #########################################################
// #########################################################
// ################## DATABASE CREATION ####################
// #########################################################
// #########################################################

// ############ USERS ###########
post('/db-create-users', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db_create_users.php');
});
post('/db-seed-users', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db_seed_users.php');
});
post('/db-seed-posts', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db_seed_posts.php');
});



// ########### ADMINS ###########

post('/db-seed-admin', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db_seed_admin.php');
});
post('/db-create-admin', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db_create_admin.php');
});


// ########### POSTS ###########
post('/db-create-posts', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db_create_posts.php');
});
post('/db-seed-posts', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db_seed_posts.php');
});





// For GET or POST
any('/404', function () {
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_404.php');
});
