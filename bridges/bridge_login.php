<?php



if (isset($_SESSION['admin_uuid'])) {
  session_destroy();
  header('Location: /login');
  exit;
}
if (!isset($_SESSION)) {
  session_start();
}

if (!isset($_POST['login_user_email'])) {
  $error_message = "Please fill in email";
  header("Location: /login/error/$error_message");


  exit();
}

if (!isset($_POST['login_user_password'])) {
  $error_message = "Please provide a password";
  header("Location: /login/error/$error_message");
  exit();
}

if (!filter_var($_POST['login_user_email'], FILTER_VALIDATE_EMAIL)) {
  $error_message = "Email is not valid";
  header("Location: /login/error/$error_message");

  exit();
}

if (
  strlen($_POST['login_user_password']) < 4 ||
  strlen($_POST['login_user_password']) > 50
) {
  $error_message = "Password must be between 4-50 characters";
  header("Location: /login/error/$error_message");
  exit();
}

try {
  $db_path = $_SERVER['DOCUMENT_ROOT'] . '/db/users.db';
  $db = new PDO("sqlite:$db_path");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $q = $db->prepare('SELECT * FROM users WHERE user_email = :user_email');
  $q->bindValue(':user_email', $_POST['login_user_email']);
  $q->execute();
  $user = $q->fetch();
  if (!$user) {
    $error_message = "The account you are trying to access does not exist";
    header("Location: /login/error/$error_message");
    exit();
  }

  $q = $db->prepare('SELECT * FROM users WHERE user_email = :user_email AND user_active = 1');
  $q->bindValue(':user_email', $_POST['login_user_email']);
  $q->execute();
  $user = $q->fetch();
  if (!$user) {
    $error_message = "The account you are trying to access is not active";
    header("Location: /login/error/$error_message");
    exit();
  }

  if (!password_verify($_POST['login_user_password'], $user['user_password'])) {
    $error_message = "Wrong Credentials my friend";
    header("Location: /login/error/$error_message");
    exit();
  }

  $_SESSION['user_uuid'] = $user['user_uuid'];
  $_SESSION['user_image'] = $user['user_image'];
  $_SESSION['user_name'] = $user['user_name'];
  $_SESSION['user_last_name'] = $user['user_last_name'];
  $_SESSION['user_image'] = $user['user_image'];
  header('Location: /main-feed');
  exit();
} catch (PDOException $ex) {
  echo $ex;
}
