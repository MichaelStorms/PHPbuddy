<?php


    // Check if user is logged in
    if(isset($_SESSION['user_id']) && isset($_SESSION['email'])){

    // If send request is activated
    if($_GET['action'] == 'sendRequest'){
        if (!empty($_GET)) {
            //echo "users";
            $requestee_id = $_GET['friend'];
            $requester_id = $_GET['user'];
            $result = friends::sendRequest($requestee_id, $requester_id);
            }
    }
    else{
        header('Location: notifications.php');
        exit;
    }

}