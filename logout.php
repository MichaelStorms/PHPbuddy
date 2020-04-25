<?php

session_start();
include_once(__DIR__ . "/classes/Chat.php");
$chat = new Chat();
$chat->updateUserOnline($_SESSION['id'], 0);

$_SESSION = array();
/*
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 100000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}*/

session_destroy();
header("Location: login.php");