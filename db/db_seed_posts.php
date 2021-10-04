<?php
/* $currentDate =  date_default_timezone_set("UTC"); */
$currentDate = date("Y-m-d H:i:s");
try {
  // require_once "../faker/autoload.php";
  require_once "{$_SERVER['DOCUMENT_ROOT']}/faker/autoload.php";
  $faker = Faker\Factory::create();
  $db_path = $_SERVER['DOCUMENT_ROOT'] . '/db/posts.db';
  $db = new PDO("sqlite:$db_path");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $q = $db->prepare("INSERT INTO posts VALUES (:post_uuid, :post_profile_user_image,
 :post_creator_name, :post_creator_last_name, :post_timestamp,
  :post_image, :post_title, :post_text, :post_likes )");
  for ($i = 0; $i < 5; $i++) {
    $count = 1;
    $q->bindValue(':post_uuid', bin2hex(random_bytes(16)));
    $q->bindValue(':post_profile_user_image', 'default-post-profile-image.jpg');
    $q->bindValue(':post_creator_name', $faker->firstName());
    $q->bindValue(':post_creator_last_name', $faker->lastName());
    $q->bindValue(':post_creator_last_name', $faker->lastName());
    $q->bindValue(':post_timestamp', $currentDate);
    $q->bindValue(':post_image', 'default-post-image.jpg');
    $q->bindValue(':post_title', $faker->lastName());
    $q->bindValue(':post_text', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluum asperiores. Soluta placeat laboriosam sit? Laudantium.');
    $q->bindValue(':post_likes', 0);

    $count++;
    $q->execute();
  }
} catch (PDOException $ex) {
  echo $ex;
}
