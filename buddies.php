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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>Document</title>
</head>

<body>
<header>
    <div class="navbar navbar-dark bg-dark box-shadow">
      <div class="container d-flex justify-content-between">
        <?php include_once("nav.inc.php"); ?>
      </div>
    </div>

  <div class="profile_container container">
        
        <div class="inner_profile float-left" style="margin-top: 2%">
            <div class="img">
                <img src="images/<?php echo $user_data->image . "" ?>" alt="Profile image" alt="profile picture of <?php echo  $user_data->firstname . " " . $user_data->lastname; ?>" style="width: 250px; ">
            </div>
            <h2><?php echo  $user_data->firstname ." ". $user_data->lastname;?></h2>
            <span><a href="UserFriendProfile.php?id='<?php echo $user_data->id?>'" class="see_profileBtn">See your profile</a>
        </div>
        <h3 style="text-align:center; width: 50%; float:left;" >bevriend met</h3>
        <div class="all_users float-right"  style="margin-top: 2%">
            <div class="usersWrapper">
                <?php
                if($get_frnd_num > 0){
                    foreach($get_all_friends as $row){
                        echo '<div class="user_box">
                                <div class="user_img"><img src="images/'.$row->image.'" alt="Profile image" style="width: 250px"></div>
                                <div class="user_info"><h2>'.$row->firstname ." ". $row->lastname.'</h2>
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