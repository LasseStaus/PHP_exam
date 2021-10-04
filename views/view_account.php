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
  $q->bindValue(':user_uuid', $_SESSION['user_uuid']);
  $q->execute();
  $user = $q->fetch();
  if (!$user) {
    header('Location: /login');
    exit();
  }
?>


  <?php
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_user_top.php');
  ?>
  <div class="profile-banner"></div>
  <div class="content-container-profile">
    <div class="profile-hero">
      <img class="profile-image" src="/uploads/<?= $user['user_image'] ?>" alt="Profile image of  <?= $user['user_last_name'] ?>">
      <h1><?= $user['user_name'] ?> <?= $user['user_last_name'] ?></h1>

    </div>
    <div class="account-content">

      <div class="options">

        <form action="/delete-account/<?= $_SESSION['user_uuid'] ?>" method="POST">
          <button type="submit" class="small">Delete account</button>
        </form>
        <a class="button edit" href="/account-edit"> <i class="fas fa-edit"></i>Edit account details</a>
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
