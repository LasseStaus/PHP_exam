<?php

/* echo $_POST['user_email']; */

if (!isset($_SESSION)) {

    session_start();
}

if (!isset($_POST['user_email'])) {
    $error_message = "Something went wrong, please go to your mail and retry";
    $error_message = "1";
    header("Location: /login/error/$error_message");
    exit();
}

if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
    $error_message = "6";
    $error_message = "Something went wrong, please go to your mail and retry";
    header("Location: /login/error/$error_message");
    exit();
}

try {
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/db/users.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare('SELECT * from users WHERE user_email = :user_email and user_active = 0');
    $q->bindValue(':user_email', $_POST['user_email']);

    $q->execute();
    $user = $q->fetchAll();

    // SELECT you must fetch or fetchAll
    if ($user) {
        $error_message = "You cannot reset password before confirming account.";
        header("Location: /login/error/$error_message");
        exit;
    }
    require_once($_SERVER['DOCUMENT_ROOT'] . '/apis/api_lost_password.php');
    exit;

    /*     header('Location: /login'); */
} catch (PDOException $ex) {
    echo $ex;
}
