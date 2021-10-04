<?php
if (!isset($_SESSION)) {
  session_start();
}

if (!isset($_SESSION['admin_uuid'])) {
  header('Location: /admin-login');
  exit();
}

try {
  $db_path = $_SERVER['DOCUMENT_ROOT'] . '/db/admins.db';
  $db = new PDO("sqlite:$db_path");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $q = $db->prepare('SELECT * FROM admins WHERE admin_uuid = :admin_uuid');
  $q->bindValue(':admin_uuid', $_SESSION['admin_uuid']);
  $q->execute();
  $user = $q->fetch();
  if (!$user) {
    header('Location: /admin-login');
    exit();
  }
?>

  <?php
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_admin_top.php');
  ?>


  <div class="admin-header">
    <h1>Account belonging to <?= $user['admin_email'] ?> </h1>

  </div>








  <?php
  require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_bottom.php');
  ?>
<?php
} catch (PDOException $ex) {
  echo $ex;
}
