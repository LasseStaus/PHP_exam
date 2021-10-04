<?php

try {
  // require_once "../faker/autoload.php";
  require_once "{$_SERVER['DOCUMENT_ROOT']}/faker/autoload.php";
  $faker = Faker\Factory::create();
  $db_path = $_SERVER['DOCUMENT_ROOT'] . '/db/admins.db';
  $db = new PDO("sqlite:$db_path");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $q = $db->prepare("INSERT INTO admins VALUES (:admin_uuid, 
 :admin_email, 
  :admin_password, :admin_active)");

  $q->bindValue(':admin_uuid', bin2hex(random_bytes(16)));
  $q->bindValue(':admin_email', 'admin@admin.com');
  $q->bindValue(':admin_password', password_hash('admin', PASSWORD_DEFAULT));
  $q->bindValue(':admin_active', 1);
  $q->execute();
} catch (PDOException $ex) {
  echo $ex;
}
