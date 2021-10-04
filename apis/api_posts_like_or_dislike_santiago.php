<?php

/* if (!ctype_digit($post_id)) {
  http_response_code(400);
  echo 'Invalid id';
  exit(); // die()
} */
if ($like_or_dislike != 0 && $like_or_dislike != 1) {
  http_response_code(400);
  echo 'Invalid like or dislike';
  exit();
}


try {
  $db_path = $_SERVER['DOCUMENT_ROOT'] . '/db/posts.db';
  $db = new PDO("sqlite:$db_path");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $q = $db->prepare("SELECT * from posts WHERE post_uuid = '$post_id'");
  $q->execute();
  $posts = $q->fetch();
  $post_number = $posts['post_likes'];
  echo var_dump($posts), $post_number;

  // SELECT you must fetch or fetchAll

  if (!$q->rowCount()) {
    echo 'something went wrong';
    exit();
  }



  /*   header('Location: /main-feed'); */
} catch (PDOException $ex) {
  echo $ex;
}





if ($like_or_dislike == 0) {
  $number = file_get_contents("{$_SERVER['DOCUMENT_ROOT']}/db/dislikes.txt");
  $number = $number + 1;
  file_put_contents("{$_SERVER['DOCUMENT_ROOT']}/db/dislikes.txt", $number);
  echo $number;
  exit();
}


if ($like_or_dislike == 1) {
  $number = file_get_contents("{$_SERVER['DOCUMENT_ROOT']}/db/likes.txt");
  $number = $number + 1;
  file_put_contents("{$_SERVER['DOCUMENT_ROOT']}/db/likes.txt", $number);
  echo $number;
  exit();
} 





// http_response_code(200) // Default for php
