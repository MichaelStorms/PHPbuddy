<?php 

if(isset($_SESSION['id']) && isset($_SESSION['user'])){
    $user_data = $user->find_user_by_id($_SESSION['id']);
    if($user_data ===  false){
        header('Location: logout.php');
        exit;
    }
    // FETCH ALL USERS WHERE ID IS NOT EQUAL TO MY ID
    $all_users = $user->all_users($_SESSION['id']);
}
else{
    header('Location: logout.php');
    exit;
}

?>