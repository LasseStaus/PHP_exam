<?php

// Validate
if (!isset($_POST['search_for'])) {
  http_response_code(400);
  exit();
}
if (strlen($_POST['search_for']) < 2) {
  http_response_code(400);
  exit();
}
if (strlen($_POST['search_for']) > 20) {
  http_response_code(400);
  exit();
}

try {
  $db_path = $_SERVER['DOCUMENT_ROOT'] . '/db/users.db';
  $db = new PDO("sqlite:$db_path");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  // full text search
  $q = $db->prepare(' SELECT user_uuid, user_name, user_last_name, user_image, user_email, user_phone 
                      FROM users 
                      WHERE user_name LIKE :user_name AND user_active == 1
                      LIMIT 20
                  
                      COLLATE NOCASE');
  $q->bindValue(':user_name', '%' . trim($_POST['search_for']) . '%');
  $q->execute();
  $users = $q->fetchAll();

  // Cannot pass arrays or json to the front-end. You can "arrays" looking like "json" looking like string
  // echo $users; // associative array
  header("Content-type:application/json");
  echo json_encode($users);
} catch (PDOException $ex) {
  echo $ex;
}
