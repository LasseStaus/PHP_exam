<?php



if (!isset($_SESSION)) {

    session_start();
}

if (!isset($_POST['user_email'])) {
    $error_message = "Something went wrong, please go to your mail and retry";

    header("Location: /login/error/$error_message");
    exit();
}
if (!isset($_POST['user_password'])) {
    $error_message = "Something went wrong, please go to your mail and retry";


    header("Location: /login/error/$error_message");
    exit();
}
if (!isset($_POST['user_confirm_password'])) {
    $error_message = "Something went wrong, please go to your mail and retry";


    header("Location: /login/error/$error_message");
    exit();
}

if ($_POST['user_password'] != $_POST['user_confirm_password']) {


    $error_message = "Something went wrong, please go to your mail and retry";
    header("Location: /login/error/$error_message");

    exit();
}
if (
    strlen($_POST['user_password']) < 2 ||
    strlen($_POST['user_password']) > 50
) {
    $error_message = "Something went wrong, please go to your mail and retry";


    header("Location: /login/error/$error_message");
    exit();
}
if (
    strlen($_POST['user_confirm_password']) < 2 ||
    strlen($_POST['user_confirm_password']) > 50
) {
    $error_message = "Something went wrong, please go to your mail and retry";


    header("Location: /login/error/$error_message");
    exit();
}


if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {

    $error_message = "Something went wrong, please go to your mail and retry";
    header("Location: /login/error/$error_message");
    exit();
}

try {
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/db/users.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare('UPDATE users SET user_password = :user_password WHERE user_email = :user_email');
    $q->bindValue(':user_email', $_POST['user_email']);
    $q->bindValue(':user_password', password_hash($_POST['user_password'], PASSWORD_DEFAULT));
    $q->execute();

    $user = $q->fetch();


    if (!$q->rowCount()) {
        $error_message = "Something went wrong, try again";
        header("Location: /create-new-password/error/$error_message");
        exit();
    }

    $success_message = "You have successfully created a new password ";
    header("Location: /login/success/$success_message");
    exit;
} catch (PDOException $ex) {
    echo $ex;
}
