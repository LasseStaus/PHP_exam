<?php

if (isset($_SESSION['admin_uuid'])) {
    header('Location: /admin-page');
    exit();
}

if (isset($_SESSION)) {
    header('Location: /main-feed');
    exit();
}

if (!isset($_SESSION)) {
    header('Location: /login');
    exit();
}
