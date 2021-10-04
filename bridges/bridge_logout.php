<?php

session_start();
session_destroy();
$success_message = "You have been logged out";
header("Location: /login/success/$success_message");

exit();
