<?php
//user_profile.php
include("init.php");
if(isset($_SESSION['id']) && isset($_SESSION['user'])){
    
    if(isset($_GET['id'])){
        $user_data = $user->find_user_by_id($_GET['id']);
        if($user_data ===  false){
            header('Location: profile.php');
            exit;
        }
        else{
            if($user_data->id == $_SESSION['id']){
                header('Location: profile.php');
                exit;
            }
        }
    }
}
else{
    header('Location: logout.php');
    exit;
}
// CHECK FRIENDS
$is_already_friends = $buddy->is_already_friends($_SESSION['id'], $user_data->id);
//  IF I AM THE REQUEST SENDER
$check_req_sender = $buddy->am_i_the_req_sender($_SESSION['id'], $user_data->id);
// IF I AM THE REQUEST RECEIVER
$check_req_receiver = $buddy->am_i_the_req_receiver($_SESSION['id'], $user_data->id);
// TOTAL REQUESTS
$get_req_num = $buddy->request_notification($_SESSION['id'], false);
// TOTAL FRIENDS
$get_frnd_num = $buddy->get_all_friends($_SESSION['id'], false);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo  $user_data->firstname." ". $user_data->lastname;?></title>
    <link rel="stylesheet" href="./style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
</head>
<body>
    <div class="profile_container">
        
        <div class="inner_profile">
            <div class="img">
                <img src="profile_images/<?php echo $user_data->image; ?>" alt="Profile image">
            </div>
            <h1><?php echo  $user_data->firstname ." ". $user_data->lastname;?></h1>
            <nav>
            <ul>
                <li><a href="profile.php" rel="noopener noreferrer">Home</a></li>
                <li><a href="notifications.php" rel="noopener noreferrer">Requests<span class="badge <?php
                if($get_req_num > 0){
                    echo 'redBadge';
                }
                ?>"><?php echo $get_req_num;?></span></a></li>
                <li><a href="buddies.php" rel="noopener noreferrer">Friends<span class="badge"><?php echo $get_frnd_num;?></span></a></li>
                <li><a href="logout.php" rel="noopener noreferrer">Logout</a></li>
            </ul>
        </nav>
            <div class="actions">
                <?php
                if($is_already_friends){
                    echo '<a href="functions.php?action=unfriend_req&id='.$user_data->id.'" class="req_actionBtn unfriend">Unfriend</a>';
                }
                elseif($check_req_sender){
                    echo '<a href="functions.php?action=cancel_req&id='.$user_data->id.'" class="req_actionBtn cancleRequest">Cancel Request</a>';
                }
                elseif($check_req_receiver){
                    echo '<a href="functions.php?action=ignore_req&id='.$user_data->id.'" class="req_actionBtn ignoreRequest">Ignore</a> 
                    <a href="functions.php?action=accept_req&id='.$user_data->id.'" class="req_actionBtn acceptRequest">Accept</a>';
                }
                else{
                    echo '<a href="functions.php?action=send_req&id='.$user_data->id.'" class="req_actionBtn sendRequest">Send Request</a>';
                }
                ?>
        
            </div>
        </div>
     
    </div>
</body>
</html>