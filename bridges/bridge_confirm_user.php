<?php





try {
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/db/users.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare('UPDATE users SET user_active = 1 WHERE user_confirmation_key == :user_confirmation_key');
    $q->bindValue(':user_confirmation_key', $user_confirmation_key);
    $q->execute();
    // SELECT you must fetch or fetchAll
    /*     $user = $q->fetch(); */
    if (!$q->rowCount()) {
        echo 'something went wrong';
        exit();
    }


    $success_message = "Your account is now active";
    header("Location: /login/success/$success_message");

    /*     header('Location: /login'); */
} catch (PDOException $ex) {
    echo $ex;
}
