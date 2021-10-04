<?php
session_start();

if (!isset($_SESSION['user_uuid'])) {
  header('Location: /login');
  exit();
}

try {
  $db_path = $_SERVER['DOCUMENT_ROOT'] . '/db/users.db';
  $db = new PDO("sqlite:$db_path");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

  $q = $db->prepare("DELETE FROM users WHERE user_uuid = '$user_id'");

  $q->execute();

  if (!$q->rowCount()) {
    header('Location: /login');
    exit();
  }

  session_destroy();
  $success_message = "Your account has entirely deleted. Thanks for you stay!";
  header("Location: /login/success/$success_message");
} catch (PDOException $ex) {
  echo $ex;
};
