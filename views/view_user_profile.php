<?php

if (!isset($_SESSION)) {
  session_start();
}

if (!isset($_SESSION['user_uuid'])) {
  header('Location: /login');
  exit();
}

try {
  $db_path = $_SERVER['DOCUMENT_ROOT'] . '/db/users.db';
  $db = new PDO("sqlite:$db_path");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $q = $db->prepare('SELECT * FROM users WHERE user_uuid = :user_uuid');
  $q->bindValue(':user_uuid', $user_uuid);
  $q->execute();
  $user = $q->fetch();
  /*   if (!$user) {
    header('Location: /login');
    exit();
  } */
?>

  <?php
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_user_top.php');
  ?>

  <div class="content-container">

    <div class="account-container">
      <h1 class="profile-header">Profile of <?= $user['user_name'] ?> <?= $user['user_last_name'] ?></h1>
      <div class="profile-image-container">
        <div class="profile-image">
          <img src="/uploads/<?= $user['user_image'] ?>" alt="Profile image of <?= $user['user_name'] ?>">
        </div>


      </div>

      <div>
        <!--     <img class="profile-image" src="/uploads/<?= $user['user_image'] ?>" alt="Profile image of  <?= $user['user_last_name'] ?>">
 -->
        <!--    <a href="/account-edit">Edit your account details</a> -->
      </div>



    </div>
  </div>

  </div>
  <?php
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_bottom.php');
  ?>
<?php
} catch (PDOException $ex) {
  echo $ex;
}
