<?php
// Top
require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_user_top.php');

if (!isset($_SESSION['user_uuid'])) {
  header('Location: /admin-login');
  exit();
}

$userID = $_SESSION['user_uuid'];
/* Was the only way i could figure out how to not fetch "myself" */

// Main part of the page
try {

  $db_path = $_SERVER['DOCUMENT_ROOT'] . '/db/users.db';
  $db = new PDO("sqlite:$db_path");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $q = $db->prepare("SELECT * FROM users WHERE user_active == 1 AND user_uuid != '$userID'");
  $q->execute();
  $users = $q->fetchAll();


?>


  <div class="user-container">
    <form onsubmit="return false" id="search-form">
      <h2>Search for users</h2>
      <div class="cont">

        <input class="search-input" name="search_for" type="text" oninput=search(<?= (json_encode($_SESSION['user_uuid'])); ?>) onclick="show_results()">

        <button class="clear-input" onclick="clear_input()">Clear search</button>
      </div>
    </form>
    <div id="search_results"></div>
    <div id="users">
      <div class="search-result-amount">
        <h3> <?= count($users)  ?> active users </h3>
      </div>
      <?php
      foreach ($users as $user) {
        unset($user['user_password']);
      ?>
        <div class="user">
          <div class="container">

            <img src="/uploads/<?= $user['user_image'] ?>" alt="Image uploaded by <?= $user['user_name'] ?>">
            <div class="user-name"> <?= $user['user_name'] ?> <?= $user['user_last_name'] ?></div>


            <a class="button user" href="/view-user-profile/<?= $user['user_uuid'] ?>">
              Go to Profile <i class="fas fa-long-arrow-alt-right"></i>
            </a>


          </div>
        </div>
    <?php
      }
      echo '</div></div>';
    } catch (PDOException $ex) {
      echo $ex;
    }


    ?>
    <script src="/js/search.js"></script>
    <?php

    require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_bottom.php');
    ?>