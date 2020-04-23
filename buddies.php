<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("init.php");

include_once("loginCheck.inc.php");
// TOTAL REQUESTS
$get_req_num = $buddy->request_notification($_SESSION['id'], false);
// TOTLA FRIENDS
$get_frnd_num = $buddy->get_all_friends($_SESSION['id'], false);
// GET MY($_SESSION['id']) ALL FRIENDS
$get_all_friends = $buddy->get_all_friends($_SESSION['id'], true);



?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Document</title>
</head>

<body>
<?php include_once("nav.inc.php"); ?>

<?php //include_once("nav.inc.php"); ?>
  <div class="profile_container">
        
        <div class="inner_profile">
            <div class="img">
                <img src="profile_images/<?php echo $user_data->image; ?>" alt="Profile image">
            </div>
            <h1><?php echo  $user_data->firstname ." ". $user_data->lastname;?></h1>
        </div>

        <div class="all_users">
            <h3>All friends</h3>
            <div class="usersWrapper">
                <?php
                if($get_frnd_num > 0){
                    foreach($get_all_friends as $row){
                        echo '<div class="user_box">
                                <div class="user_img"><img src="profile_images/'.$row->image.'" alt="Profile image"></div>
                                <div class="user_info"><span>'.$row->firstname ." ". $row->lastname.'</span>
                                <span><a href="UserFriendProfile.php?id='.$row->id.'" class="see_profileBtn">See profile</a></div>
                            </div>';
                    }
                }
                else{
                    echo '<h4>You have no friends!</h4>';
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
</body>

</html>