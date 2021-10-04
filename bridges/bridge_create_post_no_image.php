<?php




if (!isset($_SESSION['user_uuid'])) {
    header('Location: /login');
    exit();
}



$currentDate =   date("Y-m-d H:i:s");

try {
    $db_path = $_SERVER['DOCUMENT_ROOT'] . '/db/posts.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare(' INSERT INTO posts 
                                         VALUES(:post_uuid, :post_user_profile_image,  :post_creator_name, :post_creator_last_name, :post_timestamp, :post_image, :post_title,
                                        :post_text, :post_likes)');
    $q->bindValue(':post_uuid', bin2hex(random_bytes(16)));
    $q->bindValue(':post_user_profile_image', $_SESSION['user_image']);
    $q->bindValue(':post_creator_name',  $_SESSION['user_name']);
    $q->bindValue(':post_creator_last_name', $_SESSION['user_last_name']);
    $q->bindValue(':post_timestamp', $currentDate);
    $q->bindValue(':post_image', 'no-image');
    $q->bindValue(':post_title', $_POST['post_title']);
    $q->bindValue(':post_text', $_POST['post_text']);
    $q->bindValue(':post_likes', 0);
    $q->execute();

    if (!$q->rowCount()) {
        echo 'something went wrong';
        exit();
    }

    header('Location: /main-feed');
    exit();
} catch (PDOException $ex) {
    echo $ex;
}
