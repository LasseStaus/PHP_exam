<?php
// Top
require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_admin_top.php');

if (!isset($_SESSION['admin_uuid'])) {
  header('Location: /admin-login');
  exit();
}
// Main part of the page
try {

  $db_path = $_SERVER['DOCUMENT_ROOT'] . '/db/users.db';
  $db = new PDO("sqlite:$db_path");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $q = $db->prepare('SELECT * FROM users WHERE user_active == 1');
  $q->execute();
  $users = $q->fetchAll();


?>
  <div class="user-container">
    <form onsubmit="return false" id="search-form">
      <h2>Search for users</h2>
      <div class="cont">

        <input class="search-input" name="search_for" type="text" oninput=search(<?= (json_encode($_SESSION['admin_uuid'])); ?>) onclick="show_results()">

        <button class="clear-input" onclick="clear_input()">Clear search</button>
      </div>
    </form>


    <div id="search_results_admin"></div>
    <div id="admin-users">
      <div class="search-result-amount grid-2">
        <h3> <?= count($users)  ?> active users </h3>
      </div>
      <?php
      foreach ($users as $user) {
        unset($user['user_password']);
      ?>
        <div class="admin-user">
          <div class="admin-user-container">



            <img src="/uploads/<?= $user['user_image'] ?>" alt="Image uploaded by <?= $user['user_name'] ?>">
            <p>
              ID:
              <span> <?= $user['user_uuid'] ?> </span>
            </p>
            <p>
              Name: <span> <?= $user['user_name'] ?></span>
            </p>
            <p>
              Last name:
              <span> <?= $user['user_last_name'] ?> </span>
            </p>
            <p>
              Email:
              <span> <?= $user['user_email'] ?> </span>
            </p>
            <p>
              Phone nr:
              <span> <?= $user['user_phone'] ?> </span>
            </p>

            <!--   <a href="/users/block/<?= $user['user_email'] ?>" class="button alert">ahref block</a> -->
            <button onclick="block_user('<?= $user['user_email'] ?>')">
              BLOCK THIS USER
            </button>
            <button class="alert" onclick="delete_user('<?= $user['user_uuid'] ?>')">
              DELETE USER COMPLETELY
            </button>
          </div>
        </div>
    <?php
      }
      echo '</div></div>';
    } catch (PDOException $ex) {
      echo $ex;
    }





    ?>
    <script>
      let searchResultAmount = document.querySelector(".search-result-amount");
      async function delete_user(user_id) {

        console.log(user_id)
        let div_user = event.target.parentNode.parentNode
        let conn = await fetch(`/users/delete/${user_id}`, {
          "method": "POST"
        })
        if (!conn.ok) {
          alert('upps');
          return
        }
        let data = await conn.text()
        console.log(data)
        div_user.remove()

      }


      async function block_user(user_email) {
        let div_user = event.target.parentNode.parentNode
        console.log(div_user)
        let conn = await fetch(`/users/block/${user_email}`, {
          "method": "POST"
        })
        console.log("this user", user_email);
        if (!conn.ok) {
          alert("upps...");
          return
        }
        let data = await conn.text()
        console.log(data)

        div_user.remove();
      }
    </script>
    </script>
    <script src="/js/search_users_admin.js"></script>

    <?php



    // Bottom
    require_once($_SERVER['DOCUMENT_ROOT'] . '/views/view_bottom.php');
    ?>