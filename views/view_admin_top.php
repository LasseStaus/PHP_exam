<?php

if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['admin_uuid'])) {
  header('Location: /admin-login');
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="apple-touch-icon" sizes="180x180" href="/assets/fav-icon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/fav-icon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/assets/fav-icon/favicon-16x16.png">
  <!--   <link rel="manifest" href="/site.webmanifest"> -->
  <link rel="mask-icon" href="/assets/fav-icon/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">


  <link rel="stylesheet" href="/css/app.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,800;1,900&display=swap" rel="stylesheet">
  <title>APP</title>
</head>

<body>


  <nav>
    <a href="/admin-users" class="logo-container">
      <img src="/assets/logo/logo.jpg" alt="">
      <p class="logo-name">Postadora</p>
    </a>

    <div class="nav-container">

      <!--    <a href="/">home</a> -->
      <a href="/admin-users">See Users</a>
      <a href=" /admin-page">Admin Profile</a>
      <a href="/admin-edit-details">Admin Reset password</a>

      <div class="session-user">

        <a href="/admin-page"></a>
      </div>
      <i class="fas fa-chevron-down chev-down"></i>
      <!--    <a href="/login">login</a>
      <a href="/signup">signup</a> -->
    </div>
  </nav>
  <div class="user-options-container">
    <i class="fas fa-times close"></i>
    <ul>
      <li>
        <div>
          <p><?= $_SESSION['admin_email'] ?></p>
          <p>Go to profile</p>
        </div>
        <a class="pos-full" href="/admin-page"></a>
      </li>
      <li> <i class="fas fa-cog"></i>Edit Account Details
        <a href="/admin-edit-details"></a>
      </li>
      <li><i class="fas fa-sign-out-alt"></i> Logout<a href="/logout"></a></li>

    </ul>

  </div>


  <main class="admin">