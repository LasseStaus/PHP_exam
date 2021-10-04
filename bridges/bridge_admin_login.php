<?php

if (!isset($_SESSION)) {

  session_start();
}

if (!isset($_POST['admin_user_email'])) {
  header('Location: /admin-login');
  exit();
}

if (!isset($_POST['admin_user_password'])) {
  header('Location: /admin-login');
  exit();
}

if (!filter_var($_POST['admin_user_email'], FILTER_VALIDATE_EMAIL)) {
  header('Location: /admin-login');
  exit();
}

if (
  strlen($_POST['admin_user_password']) < 2 ||
  strlen($_POST['admin_user_password']) > 50
) {
  header('Location: /admin-login');
  exit();
}

try {
  $db_path = $_SERVER['DOCUMENT_ROOT'] . '/db/admins.db';
  $db = new PDO("sqlite:$db_path");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $q = $db->prepare('SELECT * FROM admins WHERE admin_email = :admin_email AND admin_active = 1');
  $q->bindValue(':admin_email', $_POST['admin_user_email']);
  $q->execute();

  $user = $q->fetch();

  if (!$user) {
    echo 'no user';
  }
  if (!password_verify($_POST['admin_user_password'], $user['admin_password'])) {
    $error_message = "Wrong Credentials my friend";
    header("Location: /admin-login/error/$error_message");
    exit();
  }

  $_SESSION['admin_uuid'] = $user['admin_uuid'];
  $_SESSION['admin_email'] = $user['admin_email'];


  header('Location: /admin-page');
  exit();
} catch (PDOException $ex) {
  echo $ex;
}
