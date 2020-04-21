<?php
session_start();
session_regenerate_id(true);

include('classes/db.php');
include('classes/user.php');
include('classes/friends.php');

// DATABASE CONNECTIONS
$conn = new Db();
$db_connection = $conn->getConnection();

// USER OBJECT
$user = new User($db_connection);
// FRIEND OBJECT
$buddy = new Buddy($db_connection);
?>