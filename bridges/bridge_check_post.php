<?php


if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_POST['post_title'])) {
    header('Location: /main-feed');
    exit;
}
if (
    strlen($_POST['post_title']) < 1 ||
    strlen($_POST['post_title']) > 50
) {
    header('Location: /main-feed');
    exit;
}
if (!isset($_POST['post_text'])) {
    header('Location: /main-feed');
    exit;
}

if (
    strlen($_POST['post_text']) < 1 ||
    strlen($_POST['post_text']) > 50
) {
    header('Location: /main-feed');
    exit;
}

/*dont hack me please*/
if ($_FILES['file-to-upload']['name']) {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/bridges/bridge_create_post_with_image.php');
    exit;
}

if (!$_FILES['file-to-upload']['name']) {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/bridges/bridge_create_post_no_image.php');
    exit;
}
