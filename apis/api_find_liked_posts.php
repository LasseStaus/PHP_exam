<?php


echo "fetching post", $post_id;


/* 


echo $post_id, $like_or_dislike, 'hej';
exit; */
/* echo $post_id;
exit; */
/* if (!ctype_digit($post_id)) {
  http_response_code(400);
  echo 'Invalid id';
  exit(); // die()
}
if ($like_or_dislike != 0 && $like_or_dislike != 1) {
  http_response_code(400);
  echo 'Invalid like or dislike';
  exit();
}

if ($like_or_dislike == 0) {
  // UPDATE posts SET likes = likes +1 WHERE post_id = 1
  $number = file_get_contents("{$_SERVER['DOCUMENT_ROOT']}/db/dislikes.txt"); // read the content of the file
  $number = $number + 1;
  // write back to the file. Second argument is the data to be written
  file_put_contents("{$_SERVER['DOCUMENT_ROOT']}/db/dislikes.txt", $number);
  echo $number;
  exit();
}


if ($like_or_dislike == 1) {
  // UPDATE posts SET likes = likes +1 WHERE post_id = 1
  $number = file_get_contents("{$_SERVER['DOCUMENT_ROOT']}/db/likes.txt"); // read the content of the file
  $number = $number + 1;
  // write back to the file. Second argument is the data to be written
  file_put_contents("{$_SERVER['DOCUMENT_ROOT']}/db/likes.txt", $number);
  echo $number;
  exit();
} */

/* echo '712adbcddf3e55585da324a3a66fad73';
echo $post_id;
exit; */
// http_response_code(200) // Default for php
try {
  $db_path = $_SERVER['DOCUMENT_ROOT'] . '/db/posts.db';
  $db = new PDO("sqlite:$db_path");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
  /*   $q = $db->prepare("UPDATE posts SET post_liked_by = post_likes + 1  WHERE post_uuid = $post_id");
  $q->execute(); */
  /*   $q = $db->prepare("UPDATE posts SET post_liked_by = '$user_id' WHERE :post_uuid = $post_id"); */
  $q = $db->prepare(" SELECT * FROM posts
                      WHERE post_uuid = :post_uuid 
                      COLLATE NOCASE");
  $q->bindValue(':post_uuid',  $post_id);
  $q->execute();
  $posts = $q->fetchAll();


  echo var_dump($posts);
  /*   echo $post['post_liked_by'];
  exit();

  if (!$q->rowCount()) {
    echo 'something went wrong';
    exit();
  } */
  // SELECT you must fetch or fetchAll
  /*     $user = $q->fetch(); */


  exit;
} catch (PDOException $ex) {
  echo $ex;
}
