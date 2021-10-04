<?php

if (!isset($_SESSION)) {

  session_start();
}



if (!isset($_POST['user_name'])) {
  $error_message = "Please fill in First name";
  header("Location: /signup/error/$error_message");
  exit();
}

if (!isset($_POST['user_last_name'])) {

  $error_message = "Please fill in Last name";
  header("Location: /signup/error/$error_message");
  exit();
}

if (!isset($_POST['user_email'])) {
  $error_message = "Please fill in Email";
  header("Location: /signup/error/$error_message");
  exit();
}


if (!isset($_POST['user_phone'])) {
  $error_message = "Please provide a phone number";
  header("Location: /signup/error/$error_message");
  exit();
}


if (!isset($_POST['user_password'])) {
  $error_message = "Please fill in Password";
  header("Location: /signup/error/$error_message");
  exit();
}

if (!isset($_POST['user_confirm_password'])) {
  $error_message = "Please fill in Confirm password";
  header("Location: /signup/error/$error_message");
  exit();
}
if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
  header('Location: /signup');
  exit();
}
if (!preg_match('/^[0-9]{8}+$/', $_POST['user_phone'])) {
  $error_message = 'Phone number cannot start with a 0';
  header("Location: /signup/error/$error_message");
  exit();
}

if (
  strlen($_POST['user_phone']) != 8
) {
  $error_message = "Phone number must be 8 digits. ";
  header("Location: /signup/error/$error_message");
  exit();
}

if (
  strlen($_POST['user_confirm_password']) < 4 ||
  strlen($_POST['user_confirm_password']) > 50
) {
  $error_message = "Password must be between 4 and 50 characters";
  header("Location: /signup/error/$error_message");
  exit();
}
if ($_POST['user_password'] != $_POST['user_confirm_password']) {
  $error_message = 'Password and Password confirm dont match';
  header("Location: /signup/error/$error_message");
  exit();
}


try {
  $user_confirmation_key = bin2hex(random_bytes(32));
  $db_path = $_SERVER['DOCUMENT_ROOT'] . '/db/users.db';
  $db = new PDO("sqlite:$db_path");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $q = $db->prepare(' INSERT INTO users 
                      VALUES(:user_uuid, :user_name, :user_last_name,
                      :user_email, :user_image, :user_phone, :user_password, :user_active, :user_confirmation_key)');
  $q->bindValue(':user_uuid', bin2hex(random_bytes(16)));
  $q->bindValue(':user_name', $_POST['user_name']);
  $q->bindValue(':user_last_name', $_POST['user_last_name']);
  $q->bindValue(':user_email', $_POST['user_email']);
  $q->bindValue(':user_image', 'default-user-image.jpg');
  $q->bindValue(':user_phone', $_POST['user_phone']);
  $q->bindValue(':user_password', password_hash($_POST['user_password'], PASSWORD_DEFAULT));
  $q->bindValue(':user_active', 0);
  $q->bindValue(':user_confirmation_key',  $user_confirmation_key);

  $q->execute();

  if (!$q->rowCount()) {
    header('Location: /signup');
    exit();
  }

  if (!isset($_SESSION)) {
    session_start();
  }

  $email_recipient =  $_POST['user_email'];
  header("Location: /signup_welcome_email/$user_confirmation_key/$email_recipient");
} catch (PDOException $ex) {

  $ex_code =  $ex->getCode();
  if ($ex_code == "23000") {
    $error_message = 'The email you entered is already in use.';
    header("Location: /signup/error/$error_message");
    exit();
  }
  echo $ex;
}
