<?php

try {
  $db_path = $_SERVER['DOCUMENT_ROOT'] . '/db/admins.db';
  $db = new PDO("sqlite:$db_path");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
  $q = $db->prepare('DROP TABLE IF EXISTS admins');
  $q->execute();
  $q = $db->prepare('CREATE TABLE admins(
    admin_uuid         TEXT UNIQUE,
    admin_email        TEXT UNIQUE,
    admin_password     TEXT,
    admin_active            TEXT,
    PRIMARY KEY(admin_uuid)
  ) WITHOUT ROWID');
  $q->execute();
} catch (PDOException $ex) {
  echo $ex;
}
