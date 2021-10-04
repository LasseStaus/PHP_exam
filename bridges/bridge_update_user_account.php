<?php

if (!isset($_SESSION)) {

  session_start();
}
//TODO LASSE SET VALIDATION FOR EMPTY EMAIL AND OTHER STUFF


if (!isset($_POST['user_name'])) {
  header('Location: /account-edit');
  exit();
}

if (!isset($_POST['user_last_name'])) {
  header('Location: /account-edit');
  exit();
}

if (!isset($_POST['user_email'])) {
  header('Location: /account-edit');
  exit();
}

if (!isset($_POST['user_password'])) {
  header('Location: /account-edit');
  exit();
}

if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
  header('Location: /account-edit');
  exit();
}
if (!preg_match('/^[0-9]{8}+$/', $_POST['user_phone'])) {

  header("Location: /account-edit");
  exit();
}

if ($_POST['user_password'] != $_POST['user_confirm_password']) {
  header('Location: /account-edit');
  exit();
}
if (
  strlen($_POST['user_password']) < 4 ||
  strlen($_POST['user_password']) > 50
) {
  header('Location: /account-edit');
  exit();
}
if (
  strlen($_POST['user_confirm_password']) < 4 ||
  strlen($_POST['user_confirm_password']) > 50
) {
  header('Location: /account-edit');
  exit();
}

try {
  $db_path = $_SERVER['DOCUMENT_ROOT'] . '/db/users.db';
  $db = new PDO("sqlite:$db_path");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $q = $db->prepare('UPDATE users SET user_name = :user_name, user_last_name = :user_last_name, user_email = :user_email,
                                      user_phone = :user_phone, user_password = :user_password 
                                      WHERE user_uuid = :user_uuid');
  $q->bindValue(':user_uuid', $_SESSION['user_uuid']);
  $q->bindValue(':user_name', $_POST['user_name']);
  $q->bindValue(':user_last_name', $_POST['user_last_name']);
  $q->bindValue(':user_email', $_POST['user_email']);
  $q->bindValue(':user_phone', $_POST['user_phone']);
  $q->bindValue(':user_password', password_hash($_POST['user_password'], PASSWORD_DEFAULT));
  $q->execute();



  if (!$q->rowCount()) {
    echo 'soemthing went wrong';
    exit;
  }

  header("Location: /account");
} catch (PDOException $ex) {
  echo $ex;
}
