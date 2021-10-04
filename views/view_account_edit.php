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
      <div class="edit-image">
        <i class="fas fa-camera"></i>

      </div>
    </div>
    <div class="edit-image-container">
      <i class="fas fa-times close-upload edit"></i>
      <img class="img-show-input profile-image-upload" src="/uploads/<?= $user['user_image'] ?>" alt="your image" />
      <form action="/upload-profile-image" method="POST" enctype="multipart/form-data">
        <input class="file-to-upload" type="file" name="file-to-upload" class="img-input" onchange="loadFile(event)">

        <button class="button" type="submit"> Upload image</button>

      </form>
    </div>
    <div class="account-content">
      <div class="options">


        <a class="button edit flex-right" href="/account"> <i class="fas fa-edit"></i>Go to account</a>
      </div>




      <div class="form-container mt-100">

        <h3>Edit your account credentials</h3>
        <form id="update-account-information" method="POST" action="/update-user-account" onsubmit="return validate();">
          <label for="user_name">First name <i class="fas fa-user"></i></label>
          <input type="text" name="user_name" data-validate="str" data-min="2" data-max="50" value="<?= $user['user_name'] ?>">
          <label for="user_last_name"> Last name<i class="fas fa-user"></i></label>
          <input type="text" name="user_last_name" data-validate="str" data-min="2" data-max="50" value="<?= $user['user_last_name'] ?>">
          <label for="user_email"> Email<i class="fas fa-envelope"></i></label>
          <input type="text" name="user_email" data-validate="email" data-min="" data-max="" value="<?= $user['user_email'] ?>">
          <label for="user_phone"> Phone no.<i class="fas fa-phone-alt"></i></label>
          <input type="text" name="user_phone" data-validate="int" data-min="2" data-max="10" value="<?= $user['user_phone'] ?>">
          <label for="user_password">New Password<i class="fas fa-lock"></i></i></label>
          <input type="password" name="user_password" data-validate="str" data-min="4" data-max="16" placeholder="Enter new password  ">
          <label for=" user_confirm_password">Confirm New Password<i class="fas fa-lock"></i></i></label>
          <input type="password" name="user_confirm_password" data-match-name="user_password" data-validate="match" data-min="4" data-max="16" placeholder="Confirm new password">
          <button>Update user information</button>

        </form>






      </div>
    </div>

  </div>
  <script src="/js/togglers_edit_account.js"></script>
  <script src="/js/image_preload.js"></script>

  <?php
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_bottom.php');
  ?>
<?php
} catch (PDOException $ex) {
  echo $ex;
}
