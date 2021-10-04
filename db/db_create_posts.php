<?php

try {
  $db_path = $_SERVER['DOCUMENT_ROOT'] . '/db/posts.db';
  $db = new PDO("sqlite:$db_path");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
  $q = $db->prepare('DROP TABLE IF EXISTS posts');
  $q->execute();
  $q = $db->prepare('CREATE TABLE posts(
    post_uuid       TEXT UNIQUE,
    post_user_profile_image      TEXT,
    post_creator_name       TEXT,
    post_creator_last_name       TEXT,
    post_timestamp       timestamp,
    post_image    TEXT,
    post_title    TEXT,
    post_text           TEXT,
    post_likes           number,
  
    PRIMARY KEY(post_uuid)
  ) WITHOUT ROWID');
  $q->execute();
} catch (PDOException $ex) {
  echo $ex;
}
