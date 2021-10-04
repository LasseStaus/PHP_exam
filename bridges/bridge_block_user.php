<?php





try {
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/db/users.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare('UPDATE users SET user_active = :user_active WHERE user_email = :user_email');
    $q->bindValue(':user_email', $user_email);
    $q->bindValue(':user_active', 0);
    $q->execute();
    // SELECT you must fetch or fetchAll
    /*     $user = $q->fetch(); */
    if (!$q->rowCount()) {
        echo 'something went wrong';
        exit();
    }


    echo 'IS BLOCKED';

    require_once($_SERVER['DOCUMENT_ROOT'] . '/apis/api_block_user_email.php');
    /*     header('Location: /login'); */
} catch (PDOException $ex) {
    echo $ex;
}
