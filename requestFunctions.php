<?php


    // Check if user is logged in
    if(isset($_SESSION['id']) && isset($_SESSION['user'])){

    // If send request is activated
    if($_GET['action'] == 'sendRequest'){
        if (!empty($_GET)) {
            //echo "users";
            $requestee_id = $_GET['friend'];
            $requester_id = $_GET['user'];
            $result = Buddy::sendRequest($requestee_id, $requester_id);
            }
    }
    else{
        header('Location: notifications.php');
        exit;
    }

}