<?php
//user_profile.php
include("init.php");
if (isset($_SESSION['id']) && isset($_SESSION['user'])) {

    if (isset($_GET['id'])) {
        $user_data = $user->find_user_by_id($_GET['id']);
        if ($user_data ===  false) {
            header('Location: profile.php');
            exit;
        } else {
            if ($user_data->id == $_SESSION['id']) {
                header('Location: profile.php');
                exit;
            }
        }
    }
} else {
    header('Location: logout.php');
    exit;
}
//CHECK TOTAL FRIENDS FROM USER
$stranger_friendsnum = $buddy->get_all_Userfriends($_GET["id"], false);
//CHECK USER ALL FRIENDS
$stranger_friendslist = $buddy->get_all_Userfriends($_GET["id"], true);

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

// GET MY($_SESSION['id']) ALL FRIENDS
$get_all_friends = $buddy->get_all_friends($_SESSION['id'], true);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo  $user_data->firstname . " " . $user_data->lastname; ?></title>
    <link rel="stylesheet" href="./style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>
    <header>
        <div class="navbar navbar-dark bg-dark box-shadow">
            <div class="container d-flex justify-content-between">
                <?php include_once("nav.inc.php"); ?>
            </div>
        </div>
    </header>
    <div class="profile_container container p-3">

        <div class="inner_profile">
            <div class="img">
                <img src="images/<?php echo $user_data->image; ?>" alt="Profile image" style="width: 20%">
            </div>
            <h1><?php echo  $user_data->firstname . " " . $user_data->lastname; ?></h1>


            <div class="actions">
                <?php
                if ($is_already_friends) {
                    echo '<a href="functions.php?action=unfriend_req&id=' . $user_data->id . '" class="req_actionBtn unfriend">Unfriend</a>';
                } elseif ($check_req_sender) {
                    echo '<a href="functions.php?action=cancel_req&id=' . $user_data->id . '" class="req_actionBtn cancleRequest">Cancel Request</a>';
                } elseif ($check_req_receiver) {
                    echo '<a href="functions.php?action=ignore_req&id=' . $user_data->id . '" class="req_actionBtn ignoreRequest">Ignore</a> 
                    <a href="functions.php?action=accept_req&id=' . $user_data->id . '" class="req_actionBtn acceptRequest">Accept</a>';
                } else {
                    echo '<a href="functions.php?action=send_req&id=' . $user_data->id . '" class="req_actionBtn sendRequest">Send Request</a>';
                }
                ?>

            </div>
        </div>

        <div>
            <h3><?php echo  $user_data->firstname . " " . $user_data->lastname; ?> Friends</h3>
        </div>


        <div class="usersWrapper">
            <div class="row">
                <?php
                if ($stranger_friendsnum > 0) {
                    foreach ($stranger_friendslist as $row) {
                        echo '
                    
                            <div class="col">
                                <div class="user_box">
                           
                                    <div class="user_img"><img src="images/' . $row->image . '" alt="Profile image" style="width: 100%;"></div>
                                    <div class="user_info"><span>' . $row->firstname . " " . $row->lastname . '</span>
                                    <span><a href="user_profile.php?id=' . $row->id . '" class="see_profileBtn">See profile</a></div>
                                </div>
                            
                        </div>';
                    }
                } else {
                    echo '<h4>You have no friends!</h4>';
                }
                ?>

            </div>
        </div>



        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>