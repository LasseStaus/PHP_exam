<?php



if (!isset($_SESSION)) {

    session_start();
}
if (!isset($_POST['admin_user_email'])) {
    header('Location: /admin-edit-details');
    exit();
}
if (!isset($_POST['admin_user_password'])) {
    header('Location: /admin-edit-details');
    exit();
}
if (!isset($_POST['admin_user_confirm_password'])) {
    header('Location: /admin-edit-details');
    exit();
}

if (
    strlen($_POST['admin_user_password']) < 2 ||
    strlen($_POST['admin_user_password']) > 50
) {
    header('Location: /login');
    exit();
}
if (
    strlen($_POST['admin_user_confirm_password']) < 2 ||
    strlen($_POST['admin_user_confirm_password']) > 50
) {
    header('Location: /login');
    exit();
}


if (!filter_var($_POST['admin_user_email'], FILTER_VALIDATE_EMAIL)) {
    header('Location: /admin-edit-details');
    exit();
}

try {
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/db/admins.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare("UPDATE admins SET admin_password = :admin_user_password WHERE admin_email = :admin_user_email");
    $q->bindValue(':admin_user_email', $_POST['admin_user_email']);
    $q->bindValue(':admin_user_password', password_hash($_POST['admin_user_password'], PASSWORD_DEFAULT));
    $q->execute();

    if (!$q->rowCount()) {
        echo 'something went wrong';
        exit();
    }


    $success_message = "Your password has been updated, Mr. admin";
    header("Location: /admin-login/password/$success_message");

    exit;
} catch (PDOException $ex) {
    echo $ex;
}
